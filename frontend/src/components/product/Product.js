import Image from "./Image";
import Name from "./Name";
import Price from "./Price";
import StarAvg from "./StarAvg";
import { NavLink } from "react-router-dom";
import { useState, useEffect } from 'react'

export default function Product(props) {

    const [isInWishlist, setIsInWishlist] = useState(false);

    // useEffect(() => {
    //     // Check if product is already in wishlist on initial render
    //     const isAlreadyInWishlist = props.wishlist.some(item => item.id === props.data.id);
    //     setIsInWishlist(isAlreadyInWishlist);
    // }, [props.wishlist, props.data.id]);

    const addToWishlist = () => {
        const { wishlist, setWishlist } = props;
        const productId = props.data.id;

        if (!wishlist.find(item => item.id === productId)) {
            const newWishlistItem = {
                id: productId,
                image: props.data.url,
                productName: props.data.name,
                price: props.data.price,
            };

            setWishlist(prevItems => [...prevItems, newWishlistItem]);
            setIsInWishlist(true);
        } else {
            alert('Sản phẩm đã có trong danh sách yêu thích!');
        }
    };


    // const addToWishlist = () => {
    //     const { wishlist, setWishlist } = props;
    //     const productId = props.data.id;

    //     // Kiểm tra nếu wishlist không phải là mảng
    //     if (!Array.isArray(wishlist)) {
    //         console.error('Wishlist is not an array');
    //         return;
    //     }

    //     // Kiểm tra xem sản phẩm đã có trong wishlist chưa
    //     let isAlreadyInWishlist = false;
    //     for (const item of wishlist) {
    //         if (item.id === productId) {
    //             isAlreadyInWishlist = true;
    //             break;
    //         }
    //     }

    //     if (!isAlreadyInWishlist) {
    //         const newWishlistItem = {
    //             id: productId,
    //             image: props.data.url,
    //             productName: props.data.name,
    //             price: props.data.price,
    //         };

    //         setWishlist(prevItems => [...prevItems, newWishlistItem]);
    //         setIsInWishlist(true);
    //     } else {
    //         alert('Sản phẩm đã có trong danh sách yêu thích!');
    //     }
    // };

    const ProductItem = ({ id }) => {
        return (
            <NavLink
                to={`/product-detail/${id}`}
                className="block2-btn flex-c-m stext-103 cl2 size-102 bg0 bor2 hov-btn1 p-lr-15 trans-04 js-show-modal1"
            >
                Quick View
            </NavLink>
        );
    };

    return (
        <>
            <div className="col-sm-6 col-md-4 col-lg-3 p-b-35 isotope-item watches">
                <div className="block2 position-relative">
                    <div className="block2-pic hov-img0">
                        <Image url={props.data.url} />
                        <ProductItem id={props.data.id} />
                    </div>
                    <div className="block2-txt flex-w flex-t p-t-14">
                        <div className="block2-txt-child1 flex-col-l ">
                            <Name name={props.data.name} />
                            <StarAvg rating={props.data.star_avg} />

                            <Price price={props.data.price} />
                        </div>
                        <div className="block2-txt-child2 flex-r p-t-3">
                            <button
                                className={`btn-addwish-b2 dis-block pos-relative js-addwish-b2 ${isInWishlist ? 'added-to-wishlist' : ''}`}
                                onClick={addToWishlist}
                            >
                                <img className="icon-heart1 dis-block trans-04" src="images/icons/icon-heart-01.png" alt="ICON" />
                                <img className="icon-heart2 dis-block trans-04 ab-t-l" src="images/icons/icon-heart-02.png" alt="ICON" />
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </>
    );
}
