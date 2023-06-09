import axios from "axios";
import React, { useState } from "react";
import StarRatings from "react-star-ratings";
import Spinner from "../../Component/Spinner";
export default function Review({ review }) {
    // console.log(...review);
    const [reviewList, setReviewList] = useState(review);
    const [rating, setRating] = useState(0);
    const [comment, setComment] = useState("");
    const [loader, setLoader] = useState(false);

    const disabledBtn = rating && comment !== "" ? false : true;
    const makeReview = () => {
        setLoader(true);
        const user_id = window.auth.id;
        const slug = window.product_slug;
        const data = { comment, user_id, slug, rating };
        axios.post("/api/make-review/" + slug, data).then(({ data }) => {
            // console.log(data);
            if (data.message === false) {
                showToast("Slug Not Found");
            } else {
                // console.log(data.data);
                setReviewList([...reviewList, data.data]);
                setLoader(false);
                setRating(0);
                setComment("");
            }
        });
    };

    return (
        <div className="col-12" style={{ marginTop: "100px" }}>
            {/* loop review */}
            {reviewList.map((d) => (
                <div className="review" key={d.id}>
                    <div className="card p-3">
                        <div className="row">
                            <div className="col-md-2">
                                <div className="d-flex justify-content-between">
                                    <img
                                        className="w-100 rounded-circle"
                                        src={d.user.image_url}
                                        alt=""
                                    />
                                </div>
                            </div>
                            <div className="col-md-10">
                                <StarRatings
                                    rating={d.rating}
                                    numberOfStars={5}
                                    starRatedColor="#fc7740"
                                    starHoverColor="#fc7740"
                                    starDimension="20px"
                                    name="rating"
                                />
                                <div className="name">
                                    <b>{d.user.name}</b>
                                </div>
                                <div className="mt-3">
                                    <small>{d.review}</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            ))}

            {window.auth && (
                <div className="add-review mt-5">
                    {loader && <Spinner />}
                    {!loader && (
                        <>
                            <h4>Make Review</h4>
                            <StarRatings
                                rating={rating}
                                starRatedColor="#fc7740"
                                starHoverColor="#fc7740"
                                numberOfStars={5}
                                changeRating={(rateCount) => {
                                    setRating(rateCount);
                                }}
                                name="rating"
                            />
                            <div>
                                <textarea
                                    value={comment}
                                    className="form-control"
                                    rows={5}
                                    placeholder="enter review"
                                    onChange={(e) => setComment(e.target.value)}
                                />
                                <button
                                    className="btn btn-dark float-right mt-3"
                                    disabled={disabledBtn}
                                    onClick={() => makeReview()}
                                >
                                    Review
                                </button>
                            </div>
                        </>
                    )}
                </div>
            )}
        </div>
    );
}

// user_id,product_id,rating,comment
