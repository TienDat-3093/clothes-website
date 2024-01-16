import { useState } from "react";
import ProductImage from "./ProductImage";
import { NavLink, useParams } from "react-router-dom";

export default function ProductDetail(props) {
  const { id } = useParams();
  const data = props.props[0];
  let sizes;
  let colors;
  

  const [selectedSize, setSelectedSize] = useState(null);
  const [selectedColor, setSelectedColor] = useState(null);
  const [quantityProduct, setQuantityProduct] = useState(null);
  const [quantity, setQuantity] = useState(1);
  const [error, setError] = useState(null);
  console.log("size", selectedSize, "color", selectedColor);

  if (data) {
    const details = data.detail;
    console.log("detail", details);
    const updateQuantity = () => {
      if (selectedSize !== null && selectedColor !== null) {
        const detail = details.find(
          (item) =>
            item.size[0].id === selectedSize &&
            item.color[0].id === selectedColor
        );
        if (detail) {
          setQuantityProduct(detail.quantity);
        } else {
          setQuantityProduct(0);
        }
      }
    };

    const uniqueSizes = new Set();
    sizes = details.map(function (item, index) {
      if (!uniqueSizes.has(item.size[0].id)) {
        uniqueSizes.add(item.size[0].id);
        return (
          <>
            <button
              key={index}
              type="button"
              className={`btn btn-icon btn-outline-secondary m-1 w-auto ${
                selectedSize === item.size[0].id ? "btn btn-info" : ""
              }`}
              style={{
                maxWidth: "70px",
              }}
              onClick={() => {
                handleSizeClick(item.size[0].id);
                updateQuantity();
              }}
            >
              {item.size[0].name}
            </button>
          </>
        );
      }
    });
    const uniqueColors = new Set();
    colors = details.map(function (item, index) {
      if (!uniqueColors.has(item.color[0].id)) {
        uniqueColors.add(item.color[0].id);
        return (
          <>
            <button
              type="button"
              className={`btn btn-icon btn-outline-secondary m-1 w-auto ${
                selectedColor === item.color[0].id ? "btn btn-info" : ""
              }`}
              style={{
                maxWidth: "70px",
              }}
              onClick={() => {
                handleColorClick(item.color[0].id);
                updateQuantity();
              }}
            >
              {item.color[0].name}
            </button>
          </>
        );
      }
    });

    const handleColorClick = (color) => {
      setSelectedColor(color);

      setQuantity(1);
    };
    const handleSizeClick = (size) => {
      setSelectedSize(size);

      setQuantity(1);
    };

    const decreaseQuantity = () => {
      if (quantity > 1) {
        setQuantity(quantity - 1);
      }
    };
    const increaseQuantity = () => {
      if (quantity < quantityProduct) {
        setQuantity(quantity + 1);
      }
    };
    const checkstore = () => {
      if (quantityProduct !== null) {
        if (quantityProduct === 0) {
          return <div style={{ color: "red" }}>Sản phẩm đã hết</div>;
        } else {
          return <div>{quantityProduct} sản phẩm có sẵn</div>;
        }
      }
    };

    const checkAddCart = () => {
      if (selectedColor !== null && selectedSize !== null) {
        if (quantityProduct !== 0) {
          addCart();
        } else {
          return setError("Sản phẩm đã hết");
        }
      } else {
        return setError("Vui lòng phân loại sản phẩm");
      }
    };

    const addCart = () => {
      const itemAdd = {
        id: props.props[0].id,
        name: props.props[0].name,
        price: props.props[0].price,
        img: props.props[0].img[0].url,
        totail_price: quantity,
        color: selectedColor,
        size: selectedSize,
      };
      console.log("product", itemAdd);
      
      
      /* window.location.href = "/cart"; */
      return <></>;
    };
    console.log("soluong_sp", quantityProduct);
    console.log("error", error);
    return (
      <>
        <div className="container"></div>
        {/* Product Detail */}
        <section className="sec-product-detail bg0 p-t-100 p-b-60">
          <div className="container">
            <div className="row">
              <ProductImage props={data.img} />
              <div
                className="col-md-6 col-lg-5 p-b-30 "
                style={{ marginLeft: 60 }}
              >
                <div className="p-r-50 p-t-5 p-lr-0-lg">
                  <h4 className="mtext-105 cl2 js-name-detail p-b-14">
                    {data.name}
                  </h4>
                  <span className="mtext-106 cl2">{data.price} đ</span>
                  <p className="stext-102 cl3 p-t-23">{data.description}</p>
                  {/*  */}
                  <div className="p-t-33">
                    <div className="flex-w flex-r-m p-b-10">
                      <div className="size-203 flex-c-m respon6">Size</div>
                      <div className="size-204 respon6-next">
                        <div className="rs1-select2 bg0">
                          <form id="sizeForm">{sizes}</form>
                          <div className="dropDownSelect2" />
                        </div>
                      </div>
                    </div>
                    <div className="flex-w flex-r-m p-b-10">
                      <div className="size-203 flex-c-m respon6">Color</div>
                      <div className="size-204 respon6-next">
                        <div className="rs1-select2 bg0">
                          <form id="colorForm">{colors}</form>
                          <div className="dropDownSelect2" />
                        </div>
                      </div>
                    </div>
                    <div className="flex-w flex-r-m p-b-10">
                      <div className="size-204 flex-w flex-m respon6-next">
                        <div className="wrap-num-product flex-w m-r-20 m-tb-10 text-truncate">
                          <div
                            className="btn-num-product-down cl8 hov-btn3 trans-04 flex-c-m"
                            onClick={decreaseQuantity}
                          >
                            <i className="fs-16 zmdi zmdi-minus" />
                          </div>
                          <input
                            className="mtext-104 cl3 txt-center num-product"
                            type="number"
                            name="num-product"
                            value={quantity}
                          />
                          <div
                            className="btn-num-product-up cl8 hov-btn3 trans-04 flex-c-m"
                            onClick={increaseQuantity}
                          >
                            <i className="fs-16 zmdi zmdi-plus" />
                          </div>
                        </div>
                        {checkstore()}
                      </div>
                    </div>
                    {quantityProduct == null && error !== null ? (
                      <div
                        style={{ color: "red" }}
                        className="mt-1 m-3 text-left"
                      >
                        {error}
                      </div>
                    ) : (
                      ""
                    )}
                    <button
                      onClick={checkAddCart}
                      className="ml-4 flex-c-m stext-101 cl0 size-101 bg1 bor1 hov-btn1 p-lr-15 trans-04 js-addcart-detail"
                    >
                      Add to cart
                    </button>
                  </div>

                  {/*  */}
                  <div className="flex-w flex-m p-l-100 p-t-40 respon7">
                    <div className="flex-m bor9 p-r-10 m-r-11">
                      <a
                        href="#"
                        className="fs-14 cl3 hov-cl1 trans-04 lh-10 p-lr-5 p-tb-2 js-addwish-detail tooltip100"
                        data-tooltip="Add to Wishlist"
                      >
                        <i className="zmdi zmdi-favorite" />
                      </a>
                    </div>
                    <a
                      href="#"
                      className="fs-14 cl3 hov-cl1 trans-04 lh-10 p-lr-5 p-tb-2 m-r-8 tooltip100"
                      data-tooltip="Facebook"
                    >
                      <i className="fa fa-facebook" />
                    </a>
                    <a
                      href="#"
                      className="fs-14 cl3 hov-cl1 trans-04 lh-10 p-lr-5 p-tb-2 m-r-8 tooltip100"
                      data-tooltip="Twitter"
                    >
                      <i className="fa fa-twitter" />
                    </a>
                    <a
                      href="#"
                      className="fs-14 cl3 hov-cl1 trans-04 lh-10 p-lr-5 p-tb-2 m-r-8 tooltip100"
                      data-tooltip="Google Plus"
                    >
                      <i className="fa fa-google-plus" />
                    </a>
                  </div>
                </div>
              </div>
            </div>
            <div className="bor10 m-t-50 p-t-43 p-b-40">
              {/* Tab01 */}
              <div className="tab01">
                {/* Nav tabs */}
                <ul className="nav nav-tabs" role="tablist">
                  <li className="nav-item p-b-10">
                    <a
                      className="nav-link active"
                      data-toggle="tab"
                      href="#description"
                      role="tab"
                    >
                      Description
                    </a>
                  </li>
                  <li className="nav-item p-b-10">
                    <a
                      className="nav-link"
                      data-toggle="tab"
                      href="#information"
                      role="tab"
                    >
                      Additional information
                    </a>
                  </li>
                  <li className="nav-item p-b-10">
                    <a
                      className="nav-link"
                      data-toggle="tab"
                      href="#reviews"
                      role="tab"
                    >
                      Reviews (1)
                    </a>
                  </li>
                </ul>
                {/* Tab panes */}
                <div className="tab-content p-t-43">
                  {/* - */}
                  <div
                    className="tab-pane fade show active"
                    id="description"
                    role="tabpanel"
                  >
                    <div className="how-pos2 p-lr-15-md">
                      <p className="stext-102 cl6">
                        Aenean sit amet gravida nisi. Nam fermentum est felis,
                        quis feugiat nunc fringilla sit amet. Ut in blandit
                        ipsum. Quisque luctus dui at ante aliquet, in hendrerit
                        lectus interdum. Morbi elementum sapien rhoncus pretium
                        maximus. Nulla lectus enim, cursus et elementum sed,
                        sodales vitae eros. Ut ex quam, porta consequat interdum
                        in, faucibus eu velit. Quisque rhoncus ex ac libero
                        varius molestie. Aenean tempor sit amet orci nec
                        iaculis. Cras sit amet nulla libero. Curabitur
                        dignissim, nunc nec laoreet consequat, purus nunc porta
                        lacus, vel efficitur tellus augue in ipsum. Cras in arcu
                        sed metus rutrum iaculis. Nulla non tempor erat. Duis in
                        egestas nunc.
                      </p>
                    </div>
                  </div>
                  {/* - */}
                  <div
                    className="tab-pane fade"
                    id="information"
                    role="tabpanel"
                  >
                    <div className="row">
                      <div className="col-sm-10 col-md-8 col-lg-6 m-lr-auto">
                        <ul className="p-lr-28 p-lr-15-sm">
                          <li className="flex-w flex-t p-b-7">
                            <span className="stext-102 cl3 size-205">
                              Weight
                            </span>
                            <span className="stext-102 cl6 size-206">
                              0.79 kg
                            </span>
                          </li>
                          <li className="flex-w flex-t p-b-7">
                            <span className="stext-102 cl3 size-205">
                              Dimensions
                            </span>
                            <span className="stext-102 cl6 size-206">
                              110 x 33 x 100 cm
                            </span>
                          </li>
                          <li className="flex-w flex-t p-b-7">
                            <span className="stext-102 cl3 size-205">
                              Materials
                            </span>
                            <span className="stext-102 cl6 size-206">
                              60% cotton
                            </span>
                          </li>
                          <li className="flex-w flex-t p-b-7">
                            <span className="stext-102 cl3 size-205">
                              Color
                            </span>
                            <span className="stext-102 cl6 size-206">
                              Black, Blue, Grey, Green, Red, White
                            </span>
                          </li>
                          <li className="flex-w flex-t p-b-7">
                            <span className="stext-102 cl3 size-205">Size</span>
                            <span className="stext-102 cl6 size-206">
                              XL, L, M, S
                            </span>
                          </li>
                        </ul>
                      </div>
                    </div>
                  </div>
                  {/* - */}
                  <div className="tab-pane fade" id="reviews" role="tabpanel">
                    <div className="row">
                      <div className="col-sm-10 col-md-8 col-lg-6 m-lr-auto">
                        <div className="p-b-30 m-lr-15-sm">
                          {/* Review */}
                          <div className="flex-w flex-t p-b-68">
                            <div className="wrap-pic-s size-109 bor0 of-hidden m-r-18 m-t-6">
                              <img src="images/avatar-01.jpg" alt="AVATAR" />
                            </div>
                            <div className="size-207">
                              <div className="flex-w flex-sb-m p-b-17">
                                <span className="mtext-107 cl2 p-r-20">
                                  Ariana Grande
                                </span>
                                <span className="fs-18 cl11">
                                  <i className="zmdi zmdi-star" />
                                  <i className="zmdi zmdi-star" />
                                  <i className="zmdi zmdi-star" />
                                  <i className="zmdi zmdi-star" />
                                  <i className="zmdi zmdi-star-half" />
                                </span>
                              </div>
                              <p className="stext-102 cl6">
                                Quod autem in homine praestantissimum atque
                                optimum est, id deseruit. Apud ceteros autem
                                philosophos
                              </p>
                            </div>
                          </div>
                          {/* Add review */}
                          <form className="w-full">
                            <h5 className="mtext-108 cl2 p-b-7">
                              Add a review
                            </h5>
                            <p className="stext-102 cl6">
                              Your email address will not be published. Required
                              fields are marked *
                            </p>
                            <div className="flex-w flex-m p-t-50 p-b-23">
                              <span className="stext-102 cl3 m-r-16">
                                Your Rating
                              </span>
                              <span className="wrap-rating fs-18 cl11 pointer">
                                <i className="item-rating pointer zmdi zmdi-star-outline" />
                                <i className="item-rating pointer zmdi zmdi-star-outline" />
                                <i className="item-rating pointer zmdi zmdi-star-outline" />
                                <i className="item-rating pointer zmdi zmdi-star-outline" />
                                <i className="item-rating pointer zmdi zmdi-star-outline" />
                                <input
                                  className="dis-none"
                                  type="number"
                                  name="rating"
                                />
                              </span>
                            </div>
                            <div className="row p-b-25">
                              <div className="col-12 p-b-5">
                                <label
                                  className="stext-102 cl3"
                                  htmlFor="review"
                                >
                                  Your review
                                </label>
                                <textarea
                                  className="size-110 bor8 stext-102 cl2 p-lr-20 p-tb-10"
                                  id="review"
                                  name="review"
                                  defaultValue={""}
                                />
                              </div>
                              <div className="col-sm-6 p-b-5">
                                <label className="stext-102 cl3" htmlFor="name">
                                  Name
                                </label>
                                <input
                                  className="size-111 bor8 stext-102 cl2 p-lr-20"
                                  id="name"
                                  type="text"
                                  name="name"
                                />
                              </div>
                              <div className="col-sm-6 p-b-5">
                                <label
                                  className="stext-102 cl3"
                                  htmlFor="email"
                                >
                                  Email
                                </label>
                                <input
                                  className="size-111 bor8 stext-102 cl2 p-lr-20"
                                  id="email"
                                  type="text"
                                  name="email"
                                />
                              </div>
                            </div>
                            <button className="flex-c-m stext-101 cl0 size-112 bg7 bor11 hov-btn3 p-lr-15 trans-04 m-b-10">
                              Submit
                            </button>
                          </form>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div className="bg6 flex-c-m flex-w size-302 m-t-73 p-tb-15">
            <span className="stext-107 cl6 p-lr-25">SKU: JAK-01</span>
            <span className="stext-107 cl6 p-lr-25">
              Categories: Jacket, Men
            </span>
          </div>
        </section>
      </>
    );
  }
}
