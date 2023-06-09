import axios from "axios";
import React, { useEffect, useState } from "react";

function ChangePassword() {
    const [currentPassword, setCurrentPassword] = useState("");
    const [newPassword, setNewPassword] = useState("");
    const [confirmPassword, setConfirmPassword] = useState("");

    //change-password
    const changePassword = () => {
        //need-to-debugging
        if (!currentPassword) {
            showToast("Current Password is Required", "error");
        } else if (!newPassword) {
            showToast("New Password is Required", "error");
        } else {
            if (newPassword !== confirmPassword) {
                showToast("Confirm Password Doesn't match", "error");
            } else {
                const user_id = window.auth.id;
                axios
                    .post(`/api/change-password?user_id=${user_id}`, {
                        currentPassword,
                        newPassword,
                    })
                    .then(({ data }) => {
                        if (data.message === false) {
                            showToast("Wrong Current Password", "error");
                        } else {
                            showToast("Password Changed Successfully");
                            setCurrentPassword("");
                            setNewPassword("");
                            setConfirmPassword("");
                        }
                    });
            }
        }
        //need-to-debugging
    };

    return (
        <div className="container-fluid mt-3">
            <div className="card p-5">
                <div className="col-6 offset-3">
                    <div className="form-group">
                        <label>Currend Password</label>
                        <input
                            type="password"
                            className="form-control"
                            onChange={(e) => setCurrentPassword(e.target.value)}
                            value={currentPassword}
                            required={true}
                        />
                    </div>
                    <div className="form-group">
                        <label>New Password</label>
                        <input
                            type="password"
                            className="form-control"
                            onChange={(e) => setNewPassword(e.target.value)}
                            value={newPassword}
                            required={true}
                        />
                    </div>
                    <div className="form-group">
                        <label>Confirm New Password</label>
                        <input
                            type="password"
                            className="form-control"
                            onChange={(e) => setConfirmPassword(e.target.value)}
                            value={confirmPassword}
                            required={true}
                        />
                    </div>
                    <button
                        className="btn btn-dark"
                        onClick={() => changePassword()}
                    >
                        Change Password
                    </button>
                </div>
            </div>
        </div>
    );
}
export default ChangePassword;
