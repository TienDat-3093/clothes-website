import React from 'react';

export default function CheckoutDetail() {

    return (
        <>
            <div>
                <div className="bg0 p-t-145 p-b-85">
                    <div className="row px-xl-5">
                        <div className="col-lg-8">
                            <div className="mb-4">
                                <h1 className="font-weight-semi-bold mb-4">Checkout</h1>
                                <div className="row">
                                    <div className="col-md-6 form-group">
                                        <label>First Name</label>
                                        <input className="form-control" type="text" placeholder="" />
                                    </div>
                                    <div className="col-md-6 form-group">
                                        <label>Last Name</label>
                                        <input className="form-control" type="text" placeholder="" />
                                    </div>
                                    <div className="col-md-6 form-group">
                                        <label>E-mail</label>
                                        <input className="form-control" type="email" placeholder="" />
                                    </div>
                                    <div className="col-md-6 form-group">
                                        <label>Phone Number</label>
                                        <input className="form-control" type="number" placeholder="" />
                                    </div>
                                    <div className="col-md-6 form-group">
                                        <label>Address</label>
                                        <input className="form-control" type="text" placeholder="" />
                                    </div>
                                    <div className="col-md-6 form-group">
                                        <label>City</label>
                                        <input className="form-control" type="text" placeholder="" />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div className="col-lg-4">
                            <div className="card border-secondary mb-5">
                                <div className="card-header bg-secondary border-0">
                                    <h4 className="font-weight-semi-bold m-0">Cart Total</h4>
                                </div>
                                <hr />
                                <div className="card-body">
                                    <div className="d-flex justify-content-between">
                                        <p>Colorful Stylish Shirt 1</p>
                                        <p>$150</p>
                                    </div>
                                    <div className="d-flex justify-content-between">
                                        <p>Colorful Stylish Shirt 2</p>
                                        <p>$150</p>
                                    </div>
                                    <div className="d-flex justify-content-between">
                                        <p>Colorful Stylish Shirt 3</p>
                                        <p>$150</p>
                                    </div>
                                    <hr className="mt-0" />
                                    <div className="d-flex justify-content-between mb-3 pt-1">
                                        <h6 className="font-weight-medium">Subtotal</h6>
                                        <h6 className="font-weight-medium">$</h6>
                                    </div>
                                </div>
                                <div className="card-footer border-secondary bg-transparent">
                                    <div className="d-flex justify-content-between mt-2">
                                        <h5 className="font-weight-bold">Total</h5>
                                        <h5 className="font-weight-bold">$</h5>
                                    </div>
                                </div>
                            </div>
                            <div className="card-footer border-secondary bg-transparent">
                                <button className="btn btn-lg btn-block btn-primary font-weight-bold my-3 py-3">Place Order</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </>
    )
}
