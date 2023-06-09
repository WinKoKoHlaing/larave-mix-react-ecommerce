import axios from "axios";
import React, { useEffect, useState } from "react";
import Spinner from "../Component/Spinner";
import MiniSpinner from "../Component/miniSpinner";

function Cart() {
    const [loader, setLoader] = useState(true);
    const [miniloader, setMiniLoader] = useState(false); //id//2
    const [cart, setCart] = useState([]);

    useEffect(() => {
        const user_id = window.auth.id;
        axios.get("/api/carts?user_id=" + user_id).then(({ data }) => {
            setCart(data.data);
            setLoader(false);
        });
    }, []);

    //update-cart-qty
    const updateQty = (id, type) => {
        const updatedQty = cart.map((d) => {
            // console.log(d);
            if (id === d.id) {
                switch (type) {
                    case "add":
                        d.total_qty += 1 && d.total_qty < 10;
                        break;

                    default:
                        d.total_qty -= 1 && d.total_qty > 1;
                        break;
                }
            }
            return d;
        });
        setCart(updatedQty);
    };

    //store-update-cart
    const saveCart = (id, qty) => {
        setMiniLoader(id);
        axios
            .post("/api/store-carts/", {
                cart_id: id,
                total_qty: qty,
            })
            .then(({ data }) => {
                if (data.message === true) {
                    showToast("Cart Quantity Saved");
                    setMiniLoader(false);
                }
            });
    };

    //delete-cart
    const destroyCart = (id) => {
        axios.post("/api/destroy-carts/", { cart_id: id }).then(({ data }) => {
            if (data.message === true) {
                setCart((preCart) => preCart.filter((d) => d.id !== id));
                showToast("Product Removed From Cart");
            }
        });
    };

    //total_price
    const TotalPrice = () => {
        var total_price = 0;
        cart.map((d) => (total_price += d.total_qty * d.product.sale_price));
        return total_price;
    };

    //checkout
    const checkOut = () => {
        setMiniLoader(true);
        const user_id = window.auth.id;
        axios.get(`/api/checkout?user_id=${user_id}`).then(({ data }) => {
            if (data.message === true) {
                setCart([]);
                window.updateCart(0);
                showToast(
                    "Checkout Success.Please wait Admin approve.Check in order list"
                );
                setMiniLoader(false);
            }
        });
    };

    return (
        <div className="container-fluid mt-3">
            <div className="card p-3">
                {loader && <Spinner />}
                {!loader && (
                    <>
                        {cart.length > 0 && (
                            <>
                                <table className="table">
                                    <thead>
                                        <tr>
                                            <th>Image</th>
                                            <th>Name</th>
                                            <th>Price</th>
                                            <th>Quantity</th>
                                            <th>Add or Reduce</th>
                                            <th>Remove</th>
                                            <th>Total Price</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        {cart.map((d) => (
                                            <tr key={d.id}>
                                                <td>
                                                    <img
                                                        src={
                                                            d.product.image_url
                                                        }
                                                        alt={d.product.name}
                                                        className="img-thumbnail"
                                                        style={{ width: 70 }}
                                                    />
                                                </td>
                                                <td>{d.product.name}</td>
                                                <td>{d.product.sale_price}</td>
                                                <td>{d.total_qty}</td>
                                                <td>
                                                    <button
                                                        className="btn btn-sm btn-dark"
                                                        onClick={() =>
                                                            updateQty(
                                                                d.id,
                                                                "reduce"
                                                            )
                                                        }
                                                    >
                                                        -
                                                    </button>
                                                    <input
                                                        type="text"
                                                        value={d.total_qty}
                                                        className="btn border-warning p-2"
                                                        style={{ width: 50 }}
                                                        disabled={true}
                                                    />
                                                    <button
                                                        className="btn btn-sm btn-dark"
                                                        onClick={() =>
                                                            updateQty(
                                                                d.id,
                                                                "add"
                                                            )
                                                        }
                                                    >
                                                        +
                                                    </button>
                                                    <button
                                                        className="btn btn-sm btn-primary"
                                                        disabled={miniloader}
                                                        onClick={() =>
                                                            saveCart(
                                                                d.id,
                                                                d.total_qty
                                                            )
                                                        }
                                                    >
                                                        {d.id ===
                                                            miniloader && (
                                                            <MiniSpinner />
                                                        )}
                                                        save
                                                    </button>
                                                </td>
                                                <td>
                                                    <button
                                                        className="btn btn-sm btn-danger"
                                                        onClick={() =>
                                                            destroyCart(d.id)
                                                        }
                                                    >
                                                        <i className="fas fa-trash"></i>
                                                    </button>
                                                </td>
                                                <td>
                                                    {d.total_qty *
                                                        d.product.sale_price}
                                                </td>
                                            </tr>
                                        ))}
                                        <tr>
                                            <td
                                                colSpan={6}
                                                className="text-right text-warning"
                                            >
                                                Total Price :
                                            </td>
                                            <td className="text-warning">
                                                <TotalPrice /> Ks
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <div className="text-center">
                                    <button
                                        className="btn btn-success"
                                        onClick={() => checkOut()}
                                    >
                                        {miniloader && <MiniSpinner />}
                                        Checkout
                                    </button>
                                </div>
                            </>
                        )}
                        {cart.length === 0 && (
                            <a href={`/`} className="text-center">
                                <button className="btn btn-success">
                                    There is no Cart . Continue Shopping{" "}
                                    <i className="fas fa-shopping-cart"></i>
                                </button>
                            </a>
                        )}
                    </>
                )}
            </div>
        </div>
    );
}
export default Cart;
