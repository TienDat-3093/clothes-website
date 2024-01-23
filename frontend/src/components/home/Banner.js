import React, { useState, useEffect } from "react";
import { fetchAllProductType } from "../../services/UserService";

export default function Banner() {
  const [productType, setProductType] = useState([]);
  const getProductType = async () => {
    try {
      let res = await fetchAllProductType();

      if (res && res.data && res.data.data) {
        const product_type = res.data.data;
        setProductType(product_type);
      }
    } catch (error) {
      console.error(error);
    }
  };
  useEffect(() => {
    getProductType();
  }, []);
  console.log("type", productType[0]);
  const loadBanner = () => {
    let listType = [];
    if (Array.isArray(productType)) {
      listType = productType.map(function (item, index) {
        return (
          <div className="col-md-6 col-xl-4 p-b-30 m-lr-auto">
            {/* Block1 */}
            <div className="block1 wrap-pic-w">
              <img src="images/banner-01.jpg" alt="IMG-BANNER" />
              <a
                href={`/shop/${item.id}`}
                className="block1-txt ab-t-l s-full flex-col-l-sb p-lr-38 p-tb-34 trans-03 respon3"
              >
                <div className="block1-txt-child1 flex-col-l">
                  <span className="block1-name ltext-102 trans-04 p-b-8">
                    {item.name}
                  </span>
                  <span className="block1-info stext-102 trans-04">
                    Spring 2024
                  </span>
                </div>
                <div className="block1-txt-child2 p-b-4 trans-05">
                  <div className="block1-link stext-101 cl0 trans-09">
                    Shop Now
                  </div>
                </div>
              </a>
            </div>
          </div>
        );
      });
    }
    return listType;
  };
  return (
    <>
      <div className="sec-banner bg0 p-t-80 ">
        {/* p-b-50 */}
        <div className="container">
          <div className="row">{loadBanner()}</div>
        </div>
      </div>
    </>
  );
}
