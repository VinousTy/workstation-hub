import React from "react";

interface PROPS {
  label: string;
}

const SubmitButton: React.FC<PROPS> = (props) => {
  return (
    <div>
      <button
        type="submit"
        className="bg-green-800 hover:bg-green-700 text-white font-bold py-2 px-4 rounded w-full transition"
      >
        {props.label}
      </button>
    </div>
  );
};

export default SubmitButton;
