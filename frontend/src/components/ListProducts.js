import React from "react";
import Product from "./product/Product";
import Filter from "./home/Filter";
import { useState, useEffect } from "react";
import Search from "./home/Search";
import { fetchAllProductType } from "../services/UserService";
export default function ListProducts(props) {
  const [isFilterVisible, setFilterVisible] = useState(false);
  const [isSearchVisible, setSearchVisible] = useState(false);
  const [productType, setProductType] = useState(null);

  const getProductType = async () => {
    try {
      let res = await fetchAllProductType();

      if (res && res.data && res.data.data) {
        const product_type = res.data.data;
        console.log("product_types", product_type);
        setProductType(product_type);
      }
    } catch (error) {
      console.error(error);
    }
  };
  useEffect(() => {
    getProductType();
  }, []);

  const toggleFilter = () => {
    setFilterVisible(!isFilterVisible);
    if (isFilterVisible === true) {
      setSearchVisible(false);
    }
  };
  const toggleSearch = () => {
    setSearchVisible(!isSearchVisible);
    if (isSearchVisible === true) {
      setFilterVisible(false);
    }
  };

  const listProducts = props.data.map(function (item, index) {
    return <Product data={item} key={index} />;
  });
  const listProductType = () => {
    if (productType !== null) {
      productType.map(function(item,index){
        console.log('product_type',item)
      })
    }
  };
  return (
    <>
      <section className="bg0 p-t-80 p-b-140">
        <div className="container">
          {/* <div className="p-b-10">
            <h3 className="ltext-103 cl5">Product Overview</h3>
          </div> */}
          {listProductType()}
          <div className="flex-w flex-sb-m p-b-52">
            <div className="flex-w flex-l-m filter-tope-group m-tb-10">
              <button
                className="stext-106 cl6 hov1 bor3 trans-04 m-r-32 m-tb-5 how-active1"
                data-filter="*"
              >
                All Products
              </button>
              <button
                className="stext-106 cl6 hov1 bor3 trans-04 m-r-32 m-tb-5"
                data-filter=".women"
              >
                Women
              </button>

              <button
                className="stext-106 cl6 hov1 bor3 trans-04 m-r-32 m-tb-5"
                data-filter=".men"
              >
                Men
              </button>
              <button
                className="stext-106 cl6 hov1 bor3 trans-04 m-r-32 m-tb-5"
                data-filter=".bag"
              >
                Bag
              </button>
              <button
                className="stext-106 cl6 hov1 bor3 trans-04 m-r-32 m-tb-5"
                data-filter=".shoes"
              >
                Shoes
              </button>
              <button
                className="stext-106 cl6 hov1 bor3 trans-04 m-r-32 m-tb-5"
                data-filter=".watches"
              >
                Watches
              </button>
            </div>
            <div className="flex-w flex-c-m m-tb-10">
              <div
                onClick={toggleFilter}
                className="flex-c-m stext-106 cl6 size-104 bor4 pointer hov-btn3 trans-04 m-r-8 m-tb-4 js-show-filter"
              >
                <i className="icon-filter cl2 m-r-6 fs-15 trans-04 zmdi zmdi-filter-list" />
                <i className="icon-close-filter cl2 m-r-6 fs-15 trans-04 zmdi zmdi-close dis-none" />
                Filter
              </div>
              <div
                onClick={toggleSearch}
                className="flex-c-m stext-106 cl6 size-105 bor4 pointer hov-btn3 trans-04 m-tb-4 js-show-search"
              >
                <i className="icon-search cl2 m-r-6 fs-15 trans-04 zmdi zmdi-search" />
                <i className="icon-close-search cl2 m-r-6 fs-15 trans-04 zmdi zmdi-close dis-none" />
                Search
              </div>
            </div>
            {}
            {/* Search product */}
            <div className="dis-none panel-search w-full p-t-10 p-b-15">
              <div className="bor8 dis-flex p-l-15">
                <button className="size-113 flex-c-m fs-16 cl2 hov-cl1 trans-04">
                  <i className="zmdi zmdi-search" />
                </button>
                <input
                  className="mtext-107 cl2 size-114 plh2 p-r-15"
                  type="text"
                  name="search-product"
                  placeholder="Search"
                />
              </div>
            </div>
            {isSearchVisible === true ? (
              <div
                className="dis-none panel-search w-full p-t-10 p-b-15"
                style={{ display: "block" }}
              >
                {isSearchVisible && <Search />}
              </div>
            ) : (
              <div
                className="dis-none panel-filter w-full p-t-10"
                style={{ display: "block" }}
              >
                {isFilterVisible && <Filter />}
              </div>
            )}
          </div>
          <div className="row isotope-grid">{listProducts}</div>
          {/* Load more */}
          <div className="flex-c-m flex-w w-full p-t-45">
            <a
              href="#"
              className="flex-c-m stext-101 cl5 size-103 bg2 bor1 hov-btn1 p-lr-15 trans-04"
            >
              Load More
            </a>
          </div>
        </div>
      </section>
    </>
  );
}
