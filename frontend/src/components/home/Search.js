import { useEffect, useState } from "react";
import { fetchSearchProduct } from "../../services/UserService";
export default function Search(props) {
    const [keyword, setKeyWord] = useState([]);

    const inputChange = (event) => {
        const key = event.target.value;
        setKeyWord(key);
    };
    const handleSearchClick = async () => {
        if (keyword !== null && keyword !== undefined && keyword !== '') {
            let res = await fetchSearchProduct(keyword);
            if (res && res.data && res.data.data) {
                props.onSearchResults(res.data.data);


            }
        }
    };
    useEffect(() => { }, []);
    return (
        <>
            <div className="bor8 dis-flex p-l-15">
                <button
                    onClick={handleSearchClick}
                    className="size-113 flex-c-m fs-16 cl2 hov-cl1 trans-04"
                >
                    <i className="zmdi zmdi-search" />
                </button>
                <input
                    className="mtext-107 cl2 size-114 plh2 p-r-15"
                    type="text"
                    name="search-product"
                    placeholder="Search"
                    onChange={inputChange}
                />
            </div>
        </>
    );
}
