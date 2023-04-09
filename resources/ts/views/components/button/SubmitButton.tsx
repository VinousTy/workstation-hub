import React from "react";

interface PROPS {
  label: string;
}

const SubmitButton: React.FC<PROPS> = (props) => {
  return (
    <div>
      <button
        type="submit"
        className="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded w-full transition"
      >
        {props.label}
      </button>
    </div>
  );
};

export default SubmitButton;
