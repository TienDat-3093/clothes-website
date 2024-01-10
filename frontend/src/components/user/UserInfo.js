import {React,useState} from "react";
import Modal from "./Modal";
import UsernameEdit from "./UsernameEdit";
import FullnameEdit from "./FullnameEdit";
const user = JSON.parse(localStorage.getItem('user'));
const UserInfo = () => {
    const [isModalOpen, setModalOpen] = useState(false);
    const [selectedComponent, setSelectedComponent] = useState(null);
    const openModal = (component) => {
        setSelectedComponent(component);
        setModalOpen(true);
      };
      
      const closeModal = () => {
        setModalOpen(false);
        setSelectedComponent(null);
      };
      return(
        <>
        <Modal isOpen={isModalOpen} onClose={closeModal}>
        {selectedComponent === "UsernameEdit" && <UsernameEdit />}
        {selectedComponent === "FullnameEdit" && <FullnameEdit />}
        </Modal>
    <div style={{width:"75%"}} className="size-210 bor10 flex-w flex-col-m p-lr-93 p-tb-30 p-lr-15-lg w-full-md">
        <label>Username</label>
            <div className="form-group" style={{ display: 'flex', alignItems: 'center' }}>
                <input
                  type="text"
                  className="form-control border-input"
                  disabled=""
                  placeholder="Username"
                  defaultValue={user.username}
                />
                <button style={{border: "1px solid #e6e6e6",padding:"6px"}} onClick={()=>openModal("UsernameEdit")}>Edit</button>
              </div>

              <label>Fullname</label>
            <div className="form-group" style={{ display: 'flex', alignItems: 'center' }}>
                <input
                  type="text"
                  className="form-control border-input"
                  disabled=""
                  placeholder="Username"
                  defaultValue={user.fullname}
                />
                <button style={{border: "1px solid #e6e6e6",padding:"6px"}} onClick={()=>openModal("FullnameEdit")}>Edit</button>
            <div>
    </div>
              </div>

              <div className="form-group">
                <label>Email</label>
                <input
                  type="text"
                  className="form-control border-input"
                  disabled=""
                  placeholder="Email"
                  defaultValue={user.email}
                />
              </div>
              <div className="form-group">
                <label>Password</label>
                <input
                  type="text"
                  className="form-control border-input"
                  disabled=""
                  placeholder="Password"
                  defaultValue="***"
                />
              </div>
              <div className="form-group">
                <label>Phone Number</label>
                <input
                  type="text"
                  className="form-control border-input"
                  disabled=""
                  placeholder="Phone Number"
                  defaultValue={user.phone_number}
                />
              </div>
            </div>
            </>
      );
}
export default UserInfo;