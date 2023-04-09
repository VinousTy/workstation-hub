import React from "react";
import { useNavigate } from "react-router-dom";

interface PROPS {
  label: string;
  transition: string;
}

const TransitionButton: React.FC<PROPS> = (props) => {
  const navigate = useNavigate();

  return (
    <div>
      <button
        onClick={() => navigate(props.transition)}
        className="text-green-800 border border-green-800 hover:bg-green-800 hover:text-gray-200 font-bold py-2 px-4 rounded w-full transition"
      >
        {props.label}
      </button>
    </div>
  );
};

export default TransitionButton;
