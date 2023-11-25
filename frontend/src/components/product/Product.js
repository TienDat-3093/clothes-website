import Image from "./Image";
import Name from "./Name";
import Price from "./Price";
import { NavLink } from "react-router-dom";
export default function Product(props) {

  return (
    <>
      <div className="col-sm-6 col-md-4 col-lg-3 p-b-35 isotope-item watches">
        <div className="block2">
          <div className="block2-pic hov-img0">
            <Image url={props.data.url}/>
            <NavLink to="/product-detail" className="block2-btn flex-c-m stext-103 cl2 size-102 bg0 bor2 hov-btn1 p-lr-15 trans-04 js-show-modal1">Quick View</NavLink>
            {/* <a
              href="#"
              className="block2-btn flex-c-m stext-103 cl2 size-102 bg0 bor2 hov-btn1 p-lr-15 trans-04 js-show-modal1"
            >
              Quick View
            </a> */}
          </div>
          <div className="block2-txt flex-w flex-t p-t-14">
            <div className="block2-txt-child1 flex-col-l ">
              <Name name={props.data.name}/>
              <Price price={props.data.price}/>
            </div>
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
    </>
  );
}
