import React, { useEffect } from "react";
import { AppDispatch } from "../../../features/store";
import { useDispatch } from "react-redux";
import { getDeskList, selectDeskList } from "../../../features/desk/deskSlice";
import { useSelector } from "react-redux";
import Slider from "react-slick";
import { settings } from "../../../lib/reactSlick/settings";
import topImage from "../../../assets/top/home.jpg";
import DeskCard from "../../components/card/DeskCard";

const TopPage = () => {
  const dispatch: AppDispatch = useDispatch();
  const deskList = useSelector(selectDeskList);

  useEffect(() => {
    const fetchDeskList = async () => {
      await dispatch(getDeskList());
    };
    fetchDeskList();
  }, []);

  return (
    <div className="min-h-screen">
      <div className="relative">
        <img
          className="w-full max-h-48 object-cover"
          src={topImage}
          alt="デスクの画像"
        />
        <div className="absolute top-0 left-0 w-full h-full bg-gradient-to-b from-transparent via-gray-800 to-gray-900 opacity-75"></div>
        <div className="absolute top-0 left-0 w-full h-full flex flex-col justify-center items-center text-white"></div>
        <div className="absolute top-0 left-0 right-0 bottom-0 flex justify-center items-center flex-col">
          <h1 className="text-3xl font-bold text-white mb-6">
            WorkStation Hub
          </h1>
          <button className="bg-white hover:bg-gray-300 text-header-color py-2 px-6 rounded-full font-semibold shadow-md transition">
            今すぐ投稿する
          </button>
        </div>
      </div>
      <div className="max-w-full mx-auto px-4 py-10">
        <Slider {...settings} className="my-6 mx-2">
          {deskList.map((data) => (
            <DeskCard
              desk={data.desk}
              user={data.user}
              profile={data.profile}
              categories={data.categories}
              images={data.images}
            />
          ))}
        </Slider>
      </div>
    </div>
  );
};

export default TopPage;
