import './App.css';
import { Route, Routes } from "react-router-dom";
import Home from './pages/Home';
import Shop from './pages/Shop';
import Login from './pages/Login';
import Cart from './pages/Cart';
import WishList from './pages/WishList';
import Detail from './pages/Detail';
import User from './pages/User';
import Register from './pages/Register';
import Blog from './pages/Blog';
import About from './pages/About';
import Contact from './pages/Contact';

function App() {
    return (
        <Routes>
            <Route path="/" element={<Home />}></Route>
            <Route path="/shop" element={<Shop />}></Route>
            <Route path="/shop/:id" element={<Shop />}></Route>
            <Route path="/product-detail/:id" element={<Detail />}></Route>
            <Route path="/login" element={<Login />}></Route>
            <Route path="/register" element={<Register />}></Route>
            <Route path="/user" element={<User />}></Route>
            <Route path="/cart" element={<Cart />}></Route>
            <Route path="/wishlist" element={<WishList />}></Route>
            <Route path='/blog' element={<Blog />}></Route>
            <Route path='/about' element={<About />}></Route>
            <Route path='/contact' element={<Contact />}></Route>
        </Routes>
    );
}

export default App;
