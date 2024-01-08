import './App.css';
import { Route, Routes } from "react-router-dom";
import Home from './pages/Home';
import Shop from './pages/Shop';
import Login from './pages/Login';
import Detail from './pages/Detail';
import User from './pages/User';

function App() {
  return (
    <Routes>
      <Route path="/" element={<Home />}></Route>
      <Route path="/shop" element={<Shop />}></Route>
      <Route path='/product-detail' element={<Detail/>}></Route>
      <Route path="/login" element={<Login />}></Route>
      <Route path="/user" element={<User />}></Route>
    </Routes>
  );
}

export default App;
