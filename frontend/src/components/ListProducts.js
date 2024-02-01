import React from "react";
import Product from "./product/Product";
import Filter from "./home/Filter";
import { useState, useEffect } from "react";
import Search from "./home/Search";
import {fetchAllCategories,fetchProductToCategory} from "../services/UserService";

export default function ListProducts(props) {
  
  const [isFilterVisible, setFilterVisible] = useState(false);
  const [isSearchVisible, setSearchVisible] = useState(false);


  const [searchResults, setSearchResults] = useState([]);
  const [categoryID, setCategotyID] = useState([]);
  const [categories, setCategories] = useState([]);
  

 
  
  const getCategories = async () => {
    try {
      let res = await fetchAllCategories();

      if (res && res.data && res.data.data) {
        const category = res.data.data;
        setCategories(category);
      }
    } catch (error) {
      console.error(error);
    }
  };
  const getCategoryDetail = async () => {
    try {
      let res = await fetchProductToCategory(categoryID);

      if (res && res.data && res.data.data) {
        const product = res.data.data;
        setSearchResults(product);
      }
    } catch (error) {
      console.error(error);
    }
  };
  useEffect(() => {
    getCategories();
    
  }, []);

  const handleSearchResults = (results) => {
    setSearchResults(results);
  };
  const handleFilterResults = (results) => {
    setSearchResults(results);
  };
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
  const CategoryID = (id) => {
    setCategotyID(id);
    getCategoryDetail();
  };

  const productDislay = searchResults.length > 0 ? searchResults : props.data;

  let listProducts = [];

  if (Array.isArray(productDislay)) {
    listProducts = productDislay.map(function (item, index) {
      return <Product data={item} key={index} />;
    });
  }
  const renderProducts = () => {
    if (listProducts.length > 0) {
      return <div className="row isotope-grid">{listProducts}</div>;
    } else {
      return (
        <div className="row isotope-grid">
          <div role="status" className="shopee-search-empty-result-section" style={{ textAlign: "center" }}>
            <img
              alt=""
              src="https://deo.shopeemobile.com/shopee/shopee-pcmall-live-sg/search/a60759ad1dabe909c46a817ecbf71878.png"
              className="shopee-search-empty-result-section__icon"
            />
            <div className="shopee-search-empty-result-section__title">
              Không tìm thấy kết quả nào
            </div>
            <div className="shopee-search-empty-result-section__hint">
              Hãy thử sử dụng các từ khóa chung chung hơn
            </div>
          </div>
        </div>
      );
    }
  };

  const listProductType = () => {
    if (categories !== null) {
      const category = categories.map(function (item, index) {
        return (
          <button
            key={index}
            className="stext-106 cl6 hov1 bor3 trans-04 m-r-32 m-tb-5"
            data-filter={item}
            onClick={() => {
              CategoryID(item.id);
            }}
          >
            {item.name}
          </button>
        );
      });
      return category;
    }
  };
  return (
    <>
      <section className="bg0 p-t-80 p-b-140">
        <div className="container">
          {/* <div className="p-b-10">
            <h3 className="ltext-103 cl5">Product Overview</h3>
          </div> */}

          <div className="flex-w flex-sb-m p-b-52">
            <div className="flex-w flex-l-m filter-tope-group m-tb-10">
              <button
                className="stext-106 cl6 hov1 bor3 trans-04 m-r-32 m-tb-5 how-active1"
                data-filter="*"
              >
                All Products
              </button>
              {listProductType()}
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
                {isSearchVisible && (
                  <Search onSearchResults={handleSearchResults} />
                )}
              </div>
            ) : (
              <div
                className="dis-none panel-filter w-full p-t-10"
                style={{ display: "block" }}
              >
                {isFilterVisible && (
                  <Filter onFilterResults={handleFilterResults} />
                )}
              </div>
            )}
          </div>
          {renderProducts()}
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
