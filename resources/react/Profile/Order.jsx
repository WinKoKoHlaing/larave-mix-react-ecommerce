import React, { Fragment, useEffect, useState } from "react";
import Spinner from "../Component/Spinner";
import axios from "axios";
function Order() {
    const [order, setOrder] = useState({});
    const [loader, setLoader] = useState(true);
    const [page, setPage] = useState(1);
    useEffect(() => {
        const user_id = window.auth.id;
        axios
            .get(`/api/orders?page=${page}&user_id=${user_id}`)
            .then(({ data }) => {
                // console.log(data.data);
                setOrder(data.data);
                setLoader(false);
            });
    }, [page]);
    return (
        <div className="container-fluid mt-3">
            <div className="card p-3">
                <Fragment>
                    {loader && <Spinner />}
                    {!loader && (
                        <>
                            <table className="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Image</th>
                                        <th>Name</th>
                                        <th>Qty</th>
                                        <th>Price</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    {/* {console.log(order)} */}
                                    {order.data.map((d) => (
                                        <tr key={d.id}>
                                            <td>
                                                <img
                                                    src={d.product.image_url}
                                                    className="img-thumbnail"
                                                    width={70}
                                                />
                                            </td>
                                            <td>{d.product.name}</td>
                                            <td>{d.total_qty}</td>
                                            <td>
                                                {d.total_qty *
                                                    d.product.sale_price}
                                            </td>
                                            <td>
                                                {d.status === "pending" && (
                                                    <div className="badge badge-primary">
                                                        pending
                                                    </div>
                                                )}
                                                {d.status === "success" && (
                                                    <div className="badge badge-success">
                                                        success
                                                    </div>
                                                )}
                                                {d.status === "cancel" && (
                                                    <div className="badge badge-danger">
                                                        cancel
                                                    </div>
                                                )}
                                            </td>
                                        </tr>
                                    ))}
                                </tbody>
                            </table>
                            <div className="d-flex justify-content-center mr-2">
                                <button
                                    className="btn btn-dark"
                                    disabled={
                                        order.prev_page_url === null
                                            ? true
                                            : false
                                    }
                                    onClick={() => setPage(page - 1)}
                                >
                                    <i className="fas fa-arrow-left"></i>
                                </button>
                                <button
                                    className="btn btn-dark"
                                    disabled={
                                        order.next_page_url === null
                                            ? true
                                            : false
                                    }
                                    onClick={() => setPage(page + 1)}
                                >
                                    <i className="fas fa-arrow-right"></i>
                                </button>
                            </div>
                        </>
                    )}
                </Fragment>
            </div>
        </div>
    );
}
export default Order;
