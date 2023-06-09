import axios from "axios";
import React, { useEffect, useState } from "react";
function Profile() {
    const [name, setName] = useState("");
    const [email, setEmail] = useState("");
    const [phone, setPhone] = useState("");
    const [image, setImage] = useState("");
    const [address, setAddress] = useState("");

    // user-data
    useEffect(() => {
        const user = window.auth;
        setName(user.name);
        setEmail(user.email);
        setPhone(user.phone);
        setImage(user.image);
        setAddress(user.address);
    }, []);

    // update-profile
    const updateProfile = () => {
        const data = {
            name,
            email,
            phone,
            image,
            address,
        };
        axios
            .post(`/api/update-profile?user_id=${window.auth.id}`, data)
            .then(({ data }) => {
                console.log(data.data);
                if (data.message === false) {
                    showToast("User Not Found");
                }
                if (data.message === true) {
                    showToast("Profile Updated");
                }
            });
    };
    return (
        <div className="container-fluid mt-3">
            <div className="card p-5">
                <div className="col-6 offset-3">
                    <div className="form-group">
                        <label>Name</label>
                        <input
                            type="text"
                            className="form-control"
                            value={name || ""}
                            onChange={(e) => setName(e.target.value)}
                        />
                    </div>
                    <div className="form-group">
                        <label>Email</label>
                        <input
                            type="email"
                            className="form-control"
                            onChange={(e) => setEmail(e.target.value)}
                            value={email || ""}
                        />
                    </div>
                    <div className="form-group">
                        <label>Phone</label>
                        <input
                            type="number"
                            className="form-control"
                            onChange={(e) => setPhone(e.target.value)}
                            value={phone || ""}
                        />
                    </div>
                    <div className="form-group">
                        <label>Image</label>
                        <ul className="nav nav-tabs" id="myTab" role="tablist">
                            <li className="nav-item" role="presentation">
                                <a
                                    className="nav-link active"
                                    id="home-tab"
                                    data-toggle="tab"
                                    href="#home"
                                    role="tab"
                                    aria-controls="home"
                                    aria-selected="true"
                                >
                                    Old
                                </a>
                            </li>
                            <li className="nav-item" role="presentation">
                                <a
                                    className="nav-link"
                                    id="profile-tab"
                                    data-toggle="tab"
                                    href="#profile"
                                    role="tab"
                                    aria-controls="profile"
                                    aria-selected="false"
                                >
                                    New
                                </a>
                            </li>
                        </ul>
                        <div className="tab-content my-2" id="myTabContent">
                            <div
                                className="tab-pane fade show active"
                                id="home"
                                role="tabpanel"
                                aria-labelledby="home-tab"
                            >
                                <img
                                    src={window.auth.image_url || ""}
                                    width={100}
                                />
                            </div>
                            <div
                                className="tab-pane fade"
                                id="profile"
                                role="tabpanel"
                                aria-labelledby="profile-tab"
                            >
                                <input
                                    type="file"
                                    className="form-control-file"
                                    id="fileInput"
                                    onChange={(e) => setImage(e.target.value)}
                                />
                            </div>
                        </div>
                    </div>

                    <div className="form-group">
                        <label>Address</label>
                        <input
                            type="text"
                            className="form-control"
                            onChange={(e) => setAddress(e.target.value)}
                            value={address || ""}
                        />
                    </div>
                    <button
                        className="btn btn-md btn-warning"
                        onClick={() => updateProfile()}
                    >
                        Update
                    </button>
                </div>
            </div>
        </div>
    );
}
export default Profile;
