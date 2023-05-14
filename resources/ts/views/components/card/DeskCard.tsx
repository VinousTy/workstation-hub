import React from "react";
import { FaUserCircle } from "react-icons/fa";

interface DeskCardProps {
  desk: {
    id: string;
  };
  user: {
    id: string;
    name: string;
  };
  profile: {
    id: string;
    file_path: string | undefined;
  };
  categories: {
    id: string;
    name: string;
  }[];
  images: string[];
}

const DeskCard: React.FC<DeskCardProps> = ({
  desk,
  user,
  profile,
  categories,
  images,
}) => {
  return (
    <div key={desk.id} className="px-2">
      <div className="bg-header-color rounded-lg shadow-md overflow-hidden">
        <img
          src={`https://picsum.photos/seed/${desk.id}/640/480`}
          alt="デスクの画像"
          className="w-full h-48 object-cover"
        />
        <div className="px-4 py-3">
          <div className="flex items-center">
            {profile?.file_path ? (
              <img
                src={profile?.file_path}
                alt="プロフィール画像"
                className="w-8 h-8 rounded-full mr-2"
              />
            ) : (
              <FaUserCircle className="text-gray-300 w-8 h-8 mr-2" />
            )}
            <p className="text-gray-400">{user.name}</p>
          </div>
        </div>
        <div className="px-3 pb-2 flex flex-wrap">
          {categories.map((category) => (
            <span
              key={category.id}
              className="bg-gray-400 rounded-full text-xs font-medium text-white py-1 px-2 mr-1 mb-1"
            >
              {category.name}
            </span>
          ))}
        </div>
      </div>
    </div>
  );
};

export default DeskCard;
