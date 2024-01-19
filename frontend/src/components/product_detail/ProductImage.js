export default function ProductImage(props) {
    const data = props.props;
    console.log(data);
    return (
        <>
            <div className="col-md-6 col-lg-5 p-b-30">
                <div className="p-l-25 p-r-30 p-lr-0-lg">
                    <div className="wrap-slick3 flex-sb flex-w">
                        <div
                            id="carouselBasicExample"
                            className="carousel slide carousel-fade"
                            data-mdb-ride="carousel"
                        >
                            <div className="carousel-indicators">
                                {data.map(function (item, index) {
                                    return (
                                        <>
                                            <button
                                                type="button"
                                                data-mdb-target="#carouselBasicExample"
                                                data-mdb-slide-to={index}
                                                className="active"
                                                aria-current="true"
                                                aria-label="Slide 1"
                                            />
                                        </>
                                    );
                                })}
                            </div>
                            {/* Inner */}
                            <div className="carousel-inner">
                                {/* Single item */}
                                {data.map(function (item, index) {
                                    return (
                                        <>
                                            {index === 0 ? (
                                                <div className="carousel-item active">
                                                    <img
                                                        src={`http://localhost:3000/${item.url}`}
                                                        className="d-block w-100"
                                                        alt="Sunset Over the City"
                                                    />
                                                </div>
                                            ) : (
                                                <div className="carousel-item">
                                                    <img
                                                        src={`http://localhost:3000/${item.url}`}
                                                        className="d-block w-100"
                                                        alt="Sunset Over the City"
                                                    />
                                                </div>
                                            )}
                                        </>
                                    );
                                })}
                            </div>

                            <button
                                className="carousel-control-prev"
                                type="button"
                                data-mdb-target="#carouselBasicExample"
                                data-mdb-slide="prev"
                            >
                                <span
                                    className="carousel-control-prev-icon"
                                    aria-hidden="true"
                                />
                                <span className="visually-hidden">Previous</span>
                            </button>
                            <button
                                className="carousel-control-next"
                                type="button"
                                data-mdb-target="#carouselBasicExample"
                                data-mdb-slide="next"
                            >
                                <span
                                    className="carousel-control-next-icon"
                                    aria-hidden="true"
                                />
                                <span className="visually-hidden">Next</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </>
    );
}
