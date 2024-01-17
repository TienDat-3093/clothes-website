import React from 'react';
import Rating from '@mui/material/Rating';

const MyRating = ({ onRatingChange }) => {
  const [value, setValue] = React.useState(0);

  const handleRatingChange = (newValue) => {
    setValue(newValue);
    onRatingChange(newValue);
  };

  return (
    <>
      <Rating
        style={{ lineHeight: '0' }}
        value={value}
        onChange={(event, newValue) => {
          handleRatingChange(newValue);
        }}
        precision={0.5}
      />
    </>
  );
};

export default MyRating;
