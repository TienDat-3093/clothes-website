import Rating from '@mui/material/Rating';
export default function StarAvg(rating) {
const number_star = parseFloat(rating.rating);
    return (
      <div className="d-flex align-items-center">
          <Rating
          style={{ lineHeight: '0' }}
          value={number_star}
          precision={0.5}
          readOnly/>
      </div>
      );
}
