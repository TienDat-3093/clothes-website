import React from 'react';

const Modal = ({ isOpen, onClose, children }) => {
    if (!isOpen) return null;
  
    return (
      <>
      <div style={{ position: 'fixed', top: 0, left: 0, width: '100%', height: '100%', background: 'rgba(0, 0, 0, 0.5)', display: 'flex', justifyContent: 'center', alignItems: 'center' }}>
      <div style={{ position: 'relative',background: 'white', padding: '20px', borderRadius: '8px' }}>
        {children}
        <button style={{ position: 'absolute', top: '10px', right: '10px', backgroundColor: 'transparent', border: 'none', cursor: 'pointer', fontSize: '14px',}} onClick={onClose}>
          X
        </button>
      </div>
    </div>
      </>
    );
  };
  
  export default Modal;