import { useState, useRef, useEffect } from "react";
import ProductImage from "./ProductImage";
import ListProducts from "../ListProducts";
import { NavLink, useParams } from "react-router-dom";
import UserRating from "./UserRating";
import Ratings from "./Ratings";
import {
	fetchAllComment,
	fetchUserComment,
	fetchProductToCategory,
} from "../../services/UserService";
import axios from "axios";

export default function ProductDetail(props) {
	const { id } = useParams();
	const [listComments, setComments] = useState([]);
	const [listProducts, setListProducts] = useState([]);
	const [nameSize, setNameSize] = useState(null);
	const [nameColor, setNameColor] = useState(null);

	const [selectedSize, setSelectedSize] = useState(null);
	const [selectedColor, setSelectedColor] = useState(null);

	const [quantityProduct, setQuantityProduct] = useState(null);
	const [quantity, setQuantity] = useState(1);

	const [error, setError] = useState(null);
	const [selectedRating, setSelectedRating] = useState(null);

	const input_content = useRef();
	const [usercart, setCart] = useState([]);
	const cartDetail = JSON.parse(localStorage.getItem("cartDetail"));

	const cart = JSON.parse(localStorage.getItem("cart"));
	const data = props.props[0];
	let sizes;
	let colors;

	const getCategories = async () => {
		let res = await fetchProductToCategory(id);
		if (res && res.data && res.data.data) {
			const product = res.data.data;

			setListProducts(product);
		}
	};
	console.log("product_ detai_2 ", listProducts);
	const getComment = async () => {
		let res = await fetchAllComment(id);

		if (res && res.data && res.data.data) {
			const comment = res.data.data;
			console.log(comment);
			setComments(comment);
		}
	};
	const submitReview = async () => {
		const token = localStorage.getItem("token");
		const user = JSON.parse(localStorage.getItem("user"));
		const cart = JSON.parse(localStorage.getItem("cart"));
		let products_id = id;
		if (!token || !user)
			return alert("Vui lòng đăng nhập để đánh giá sản phẩm!");
		let allowComment = false;
		cart.forEach(item => {
			if (item.status_carts_id == 5 && cartDetail.some(detail => detail.products_id == products_id && detail.carts_id == item.id)) {
				allowComment = true;
			}
		});
		if (!allowComment) {
			alert("Bạn không thể đánh sản phẩm chưa mua!");
		}
		 else {
		let content = input_content.current.value;
		let ratings = selectedRating;
		if (!ratings || ratings == 0) return alert("Vui lòng đánh giá sản phẩm!");
		let users_id = user.id;
		try {
			const response = await axios.post(
				"http://127.0.0.1:8000/api/comment",
				{ content, ratings, users_id, products_id },
				{
					headers: {
						Authorization: "Bearer " + token,
						Accept: "application/json",
					},
				}
			);
			await fetchUserComment(user.id, token);
			alert(response.data.message);
		} catch (error) {
			if (
				error.response.data.exception ==
				"Illuminate\\Database\\UniqueConstraintViolationException"
			)
				return alert("Bạn đã đánh giá sản phẩm này rồi");
			alert("Error: " + error.response.data.message);
		}
		console.log(input_content.current.value, selectedRating, user.id, id);
	}
	};

	const handleRatingChange = (newValue) => {
		setSelectedRating(newValue);
	};
	useEffect(() => {
		const storedCart = JSON.parse(localStorage.getItem("usercart")) || [];
		getComment();
		setCart(storedCart);
		getComment();
		getCategories();
	}, []);

	if (data) {
		const details = data.detail;
		// console.log("detail", details);
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
							className={`btn btn-icon btn-outline-secondary m-1 w-auto ${selectedSize === item.size[0].id ? "btn btn-info" : ""
								}`}
							style={{
								maxWidth: "70px",
							}}
							// onClick={() => {
							//     handleSizeClick(item.size[0].id);
							//     updateQuantity();
							// }}
							onClick={() => {
								// handleSizeClick(item.size[0].id);
								handleSizeClick({
									id: item.size[0].id,
									name: item.size[0].name,
								});
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
							className={`btn btn-icon btn-outline-secondary m-1 w-auto ${selectedColor === item.color[0].id ? "btn btn-info" : ""
								}`}
							style={{
								maxWidth: "70px",
							}}
							// onClick={() => {
							//     handleColorClick(item.color[0].id);
							//     updateQuantity();
							// }}
							onClick={() => {
								handleColorClick({
									id: item.color[0].id,
									name: item.color[0].name,
								});
								// handleColorClick(item.color[0].id);
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
			setSelectedColor(color.id);
			setNameColor(color.name);
			setQuantity(1);
		};
		const handleSizeClick = (size) => {
			setSelectedSize(size.id);
			setNameSize(size.name);
			setQuantity(1);
		};

		const decreaseQuantity = () => {
			if (quantity > 1) {
				setQuantity(quantity - 1);
			}
		};
		// const increaseQuantity = () => {
		//     if (quantity < quantityProduct) {
		//         setQuantity(quantity + 1);
		//     }
		// };
		const increaseQuantity = () => {
			if (quantity < quantityProduct) {
				setQuantity(quantity + 1);
			} else {
				alert("Không thể thêm số lượng lớn hơn số lượng sản phẩm đang có.");
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
		const addToCart = () => {
			if (selectedSize !== null) {
				if (quantityProduct !== 0) {
					addCart();
				} else {
					return setError("Sản phẩm đã hết");
				}
			} else return setError("Vui lòng chọn kích cỡ sản phẩm");
			if (selectedColor !== null) {
				if (quantityProduct !== 0) {
					addCart();
				} else {
					return setError("Sản phẩm đã hết");
				}
			} else return setError("Vui lòng chọn màu sản phẩm");
			if (
				selectedColor !== null &&
				selectedSize !== null &&
				quantityProduct > 0
			) {
				// console.log('usercart', usercart)
				// const existingItemIndex = usercart.findIndex(
				//     item => item.products_id == id && item.sizes_id == selectedSize && item.colors_id == selectedColor

				// );

				let existingItemIndex = -1;
				for (let i = 0; i < usercart.length; i++) {
					if (
						usercart[i].products_id === id &&
						usercart[i].sizes_id === selectedSize &&
						usercart[i].colors_id === selectedColor
					) {
						existingItemIndex = i;
						break;
					}
				}

				// console.log('check dk', existingItemIndex)
				if (existingItemIndex !== -1) {
					// console.log('ton tai')

					const updatedCart = [...usercart];
					updatedCart[existingItemIndex].quantity += quantity;

					setCart(updatedCart);
					localStorage.setItem("usercart", JSON.stringify(updatedCart));
				} else {
					const newItem = {
						quantity: quantity,
						price: data.price,
						products_id: id,
						name: data.name,
						sizes_id: selectedSize,
						sizes_name: nameSize,
						colors_id: selectedColor,
						colors_name: nameColor,
						image: data.img[0],
					};

					setCart([...usercart, newItem]);

					localStorage.setItem(
						"usercart",
						JSON.stringify([...usercart, newItem])
					);
				}

				alert("Sản phẩm đã được thêm vào giỏ hàng");
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
			// console.log("product", itemAdd);

			/* window.location.href = "/usercart"; */
			return <></>;
		};
		// console.log("soluong_sp", quantityProduct);
		// console.log("error", error);
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
									<span className="mtext-106 cl2">${data.price}</span>
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
											onClick={addToCart}
											className="ml-4 flex-c-m stext-101 cl0 size-101 bg1 bor1 hov-btn1 p-lr-15 trans-04 js-addcart-detail"
										>
											Add to usercart
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
													<Ratings data={listComments} />
													{/* Add review */}
													<h5 className="mtext-108 cl2 p-b-7">Add a review</h5>
													<div className="flex-w flex-m p-t-50 p-b-23">
														<span className="stext-102 cl3 m-r-16">
															Your UserRating
														</span>
														<span className="wrap-rating fs-18 cl11 pointer">
															<UserRating onRatingChange={handleRatingChange} />
														</span>
													</div>
													<div className="row p-b-25">
														<div className="col-12 p-b-5">
															<label className="stext-102 cl3" htmlFor="review">
																Your review
															</label>
															<textarea
																className="size-110 bor8 stext-102 cl2 p-lr-20 p-tb-10"
																id="review"
																name="review"
																ref={input_content}
																defaultValue={""}
															/>
														</div>
													</div>
													<button
														onClick={submitReview}
														className="flex-c-m stext-101 cl0 size-112 bg7 bor11 hov-btn3 p-lr-15 trans-04 m-b-10"
													>
														Submit
													</button>
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
					<ListProducts data={listProducts} />
				</section>
			</>
		);
	}
}
