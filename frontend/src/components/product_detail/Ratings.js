import React from 'react';
import Rating from '@mui/material/Rating';

const Ratings = (props) => {
    const listComments = props.data.map(function (item, index) {
        return (
            <div className="size-207" key={index}>
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
        );

    });
    return (
        <>
            <div className="flex-w flex-t p-b-68">
                {listComments}
            </div>
        </>
    )
}
export default Ratings;