import {React,useState} from "react";
import Modal from "./Modal";
import UsernameEdit from "./UsernameEdit";
import FullnameEdit from "./FullnameEdit";
import EmailEdit from "./EmailEdit";
import PasswordEdit from "./PasswordEdit";
import PhoneNumberEdit from "./PhoneNumberEdit";
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
        {selectedComponent === "EmailEdit" && <EmailEdit />}
        {selectedComponent === "PasswordEdit" && <PasswordEdit />}
        {selectedComponent === "PhoneNumberEdit" && <PhoneNumberEdit />}
        </Modal>
            <div style={{width:"75%"}} className="size-210 bor10 flex-w flex-col-m p-lr-93 p-tb-30 p-lr-15-lg w-full-md">
              <label>Username</label>
              <div className="form-group" style={{ display: 'flex', alignItems: 'center' }}>
              <div className="form-control border-input">{user.username}</div>
                <button style={{border: "1px solid #e6e6e6",padding:"6px"}} onClick={()=>openModal("UsernameEdit")}>Edit</button>
              </div>

              <label>Fullname</label>
              <div className="form-group" style={{ display: 'flex', alignItems: 'center' }}>
              <div className="form-control border-input">{user.fullname}</div>
                <button style={{border: "1px solid #e6e6e6",padding:"6px"}} onClick={()=>openModal("FullnameEdit")}>Edit</button>
              </div>

              <label>Email</label>
              <div className="form-group" style={{ display: 'flex', alignItems: 'center' }}>
              <div className="form-control border-input">{user.email}</div>
                <button style={{border: "1px solid #e6e6e6",padding:"6px"}} onClick={()=>openModal("EmailEdit")}>Edit</button>
              </div>

              <label>Password</label>
              <div className="form-group" style={{ display: 'flex', alignItems: 'center' }}>
              <div className="form-control border-input">******</div>
                <button style={{border: "1px solid #e6e6e6",padding:"6px"}} onClick={()=>openModal("PasswordEdit")}>Edit</button>
              </div>

              <label>Phone Number</label>
              <div className="form-group" style={{ display: 'flex', alignItems: 'center' }}>
                <div className="form-control border-input">{user.phone_number}</div>
                <button style={{border: "1px solid #e6e6e6",padding:"6px"}} onClick={()=>openModal("PhoneNumberEdit")}>Edit</button>
              </div>
            </div>
            </>
      );
}
export default UserInfo;