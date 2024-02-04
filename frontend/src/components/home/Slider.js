import React from "react";
import { useState, useEffect } from "react";
import { fetchSlideShow } from "../../services/UserService";

export default function Slider() {
    const [slideshow, setSlideShow] = useState([]);

    const getSlideShow = async () => {
        try {
            let res = await fetchSlideShow();

            if (res && res.data && res.data.data) {
                const data = res.data.data;
                setSlideShow(data);
            }
        } catch (error) {
            console.error(error);
        }
    };
    useEffect(() => {
        getSlideShow();
    }, []);
    console.log(slideshow);
    return (
        <>
            {/* Carousel wrapper */}
            <div
                id="carouselBasicExample"
                className="carousel slide carousel-fade"
                data-mdb-ride="carousel"
            >
                {/* Indicators */}
                <div className="carousel-indicators">
                    {slideshow.map(function (item, index) {
                        return (
                            <>
                                {index === 0 ? (<button
                                    type="button"
                                    data-mdb-target="#carouselBasicExample"
                                    data-mdb-slide-to={index}
                                    className="active"
                                    aria-current="true"
                                    aria-label="Slide 1"
                                />) : (<button
                                    type="button"
                                    data-mdb-target="#carouselBasicExample"
                                    data-mdb-slide-to={index}
                                    aria-current="true"
                                    aria-label="Slide 1"
                                />)}

                            </>
                        );
                    })}
                </div>
                {/* Inner */}
                <div className="carousel-inner">
                    {/* Single item */}
                    {slideshow.map(function (item, index) {
                        return (
                            <>
                                {index === 0 ? (<div className="carousel-item active">
                                    <img
                                        src={`http://localhost:3000/${item.url}`}
                                        className="d-block w-100"
                                        alt="Sunset Over the City"
                                    />
                                    {/* <div className="carousel-caption d-none d-md-block">
                    <h5>First slide label</h5>
                    <p>
                      Nulla vitae elit libero, a pharetra augue mollis interdum.
                    </p>
                  </div> */}
                                </div>) : (<div className="carousel-item">
                                    <img
                                        src={`http://localhost:3000/${item.url}`}
                                        className="d-block w-100"
                                        alt="Sunset Over the City"
                                    />
                                    {/* <div className="carousel-caption d-none d-md-block">
                    <h5>First slide label</h5>
                    <p>
                      Nulla vitae elit libero, a pharetra augue mollis interdum.
                    </p>
                  </div> */}
                                </div>)}

                            </>
                        );
                    })}



                </div>
                {/* Inner */}
                {/* Controls */}
                <button
                    className="carousel-control-prev"
                    type="button"
                    data-mdb-target="#carouselBasicExample"
                    data-mdb-slide="prev"
                >
                    <span className="carousel-control-prev-icon" aria-hidden="true" />
                    <span className="visually-hidden">Previous</span>
                </button>
                <button
                    className="carousel-control-next"
                    type="button"
                    data-mdb-target="#carouselBasicExample"
                    data-mdb-slide="next"
                >
                    <span className="carousel-control-next-icon" aria-hidden="true" />
                    <span className="visually-hidden">Next</span>
                </button>
            </div>
            {/* Carousel wrapper */}
        </>
    );
}
