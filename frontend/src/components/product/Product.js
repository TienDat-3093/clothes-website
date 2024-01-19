import Image from "./Image";
import Name from "./Name";
import Price from "./Price";
import StarAvg from "./StarAvg";
import { NavLink } from "react-router-dom";
export default function Product(props) {
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
            <Image url={"http://localhost:8000/" + props.data.url} />
            <ProductItem id={props.data.id} />
            {/* <a
              href="#"
              className="block2-btn flex-c-m stext-103 cl2 size-102 bg0 bor2 hov-btn1 p-lr-15 trans-04 js-show-modal1"
            >
              Quick View
            </a> */}
          </div>
          <div className="block2-txt flex-w flex-t p-t-14">
            <div className="block2-txt-child1 flex-col-l ">
              <Name name={props.data.name} />
              <StarAvg rating={props.data.star_avg} />

              <Price price={props.data.price} />
            </div>
            <div className="block2-txt flex-w flex-t p-t-14">

              <div className="block2-txt-child2 flex-r p-t-3">
                <a
                  href="#"
                  className="btn-addwish-b2 dis-block pos-relative js-addwish-b2"
                >
                  <img
                    className="icon-heart1 dis-block trans-04"
                    src="images/icons/icon-heart-01.png"
                    alt="ICON"
                  />
                  <img
                    className="icon-heart2 dis-block trans-04 ab-t-l"
                    src="images/icons/icon-heart-02.png"
                    alt="ICON"
                  />
                </a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </>
  );
}
