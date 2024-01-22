import {React,useEffect} from "react";
import { fetchUserCart,cancelUserCart } from "../../services/UserService";
export default function MyOrders(){
   const user = JSON.parse(localStorage.getItem('user'));
   const token = localStorage.getItem('token');
   useEffect(()=>{
      fetchUserCart(user.id,token);
   })
   const cart = JSON.parse(localStorage.getItem('cart'))|| [];
   const cartDetail = JSON.parse(localStorage.getItem('cartDetail'))|| [];
   console.log(cartDetail);
   const CancelCart = async (id) =>{
      try{
            await cancelUserCart(id,token).then(response=>{
               alert(response.data.message)
            })
            await fetchUserCart(user.id,token);
            window.location.reload();
         }
         catch(error){
               alert("Error: "+ error);
            }
         }
   const listUserCart = cart.map(function (item, index) {
      const filteredCartDetail = cartDetail.filter(cartItem => cartItem.carts_id === item.id)
      .map(function (item,index){
         return(
         <div key={index} className="size-207 bor10 p-lr-93 p-tb-30 p-lr-15-lg">
         <div className="flex-w flex-sb-m p-b-17">
           <span className="mtext-107 cl2 p-r-20">
           <b>Product: </b>{item.products.name}
           </span>
           <span className="mtext-107 cl2 p-r-20">
           <b>Quantity: </b>{item.quantity}
           </span>
         </div>
         <div className="stext-102 cl6 flex-w flex-sb-m p-b-17">
         <span className="mtext-107 cl2 p-r-20">
            <b>Color: </b> {item.colors.name}
         </span>
         <span className="mtext-107 cl2 p-r-20">
            <b>Size: </b> {item.sizes.name}
         </span>
         </div>
         </div>
   )});
      return(
         <div key={index}>
         <b>Order {index+1}</b>
         <div className="form-group" style={{ display: 'flex', alignItems: 'center' }}>
         <div className="size-207 bor10 p-lr-93 p-tb-30 p-lr-15-lg">
         <div className="flex-w flex-sb-m p-b-17">
           <span className="mtext-107 cl2 p-r-20">
           <b>Total: </b>{item.total_price}
           </span>
           <span className="mtext-107 cl2 p-r-20">
           <b>Status: </b>{item.status}
           </span>
         </div>
         <p className="stext-102 cl6">
         <b>Order made at: </b> {item.created_at}
         </p>
         </div>
         {(item.status_carts_id < 3 && item.status_carts_id >= 1 )? (
         <button style={{border: "1px solid #e6e6e6",height:"143px",padding:"6px",backgroundColor:"black",color:"white"}} onClick={() => CancelCart(item.id)}>Cancel Order</button>
         ):(
         <button style={{border: "1px solid #e6e6e6",height:"143px",padding:"6px",backgroundColor:"grey",color:"white"}}>Cancel Order</button>
         )}
         </div>
         <b>Items:</b>
         {filteredCartDetail}
         </div>
      );
   });
 return(
    <>
    <div style={{width:"75%"}} className="size-210 bor10 flex-w flex-col-m p-lr-93 p-tb-30 p-lr-15-lg w-full-md">
    <p>My Order Menu</p>
    {listUserCart.length > 0 ? listUserCart : "No orders from you yet!"}
    </div>
    </>
 );
}