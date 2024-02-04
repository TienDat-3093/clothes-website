import { React, useEffect } from "react";
import Rating from '@mui/material/Rating';
import { deleteUserComment, fetchUserComment } from "../../services/UserService";
export default function MyRatings() {
    const token = localStorage.getItem('token');
    const user = JSON.parse(localStorage.getItem('user'));
    useEffect(() => {
        fetchUserComment(user.id, token);
    })
    const comment = JSON.parse(localStorage.getItem('comment')) || [];
    const RemoveComment = async (id) => {
        try {
            await deleteUserComment(id, token).then(response => {
                alert(response.data.message)
            })
            await fetchUserComment(user.id, token);
            window.location.reload();
        } catch (error) {
            alert("Error: " + error);
        }
    }
    const listUserComments = comment.map(function (item, index) {
        return (
            <div className="form-group" key={index} style={{ display: 'flex', alignItems: 'center' }}>
                <div className="size-207 bor10 p-lr-93 p-tb-30 p-lr-15-lg">
                    <div className="flex-w flex-sb-m p-b-17">
                        <span className="mtext-107 cl2 p-r-20">
                            {item.username}
                        </span>
                        <Rating
                            style={{ lineHeight: '0' }}
                            value={item.ratings}
                            precision={0.5}
                            readOnly />
                    </div>
                    <p className="stext-102 cl6">
                        {item.content}
                    </p>
                </div>
                <button style={{ border: "1px solid #e6e6e6", height: "143px", padding: "6px", backgroundColor: "black", color: "white" }} onClick={() => RemoveComment(item.id)}>Delete</button>
            </div>
        );
    });
    return (
        <>
            <div style={{ width: "75%" }} className="size-210 bor10 flex-w flex-col-m p-lr-93 p-tb-30 p-lr-15-lg w-full-md">
                <h2>My Ratings</h2>
                {listUserComments.length > 0 ? listUserComments : "No comments from you yet!"}
            </div>
        </>
    );
}