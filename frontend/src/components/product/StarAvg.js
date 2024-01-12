export default function StarAvg(rating) {
const number_star = parseFloat(rating.rating);
  const maxStars = 5;
  const fullStars = Math.floor(number_star);
  const halfStar = number_star % 1 !== 0;

  const Star = () => {
    const stars = [];
    for (let i = 0; i < fullStars; i++) {
      stars.push(
        <span key={i} className="bx bxs-star"></span>
      );
    }
    if (halfStar) {
      stars.push(
        <span key='half' className="bx bxs-star-half"></span>
      );
    }
    const remainingStars = maxStars - (fullStars + halfStar);
    for (let i = 0; i < remainingStars; i++) {
      stars.push(
        <span key={i +fullStars + halfStar}  className="bx bx-star"></span>
      );
    }
    return stars;
  };
  return <div className="d-flex align-items-center">{Star()}</div>;
}
