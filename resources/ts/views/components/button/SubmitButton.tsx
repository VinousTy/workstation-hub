import React from "react";

interface PROPS {
  label: string;
  clickEvent?: () => Promise<void>;
}

const SubmitButton: React.FC<PROPS> = (props) => {
  const buttonType = props.clickEvent ? "button" : "submit";

  return (
    <div>
      <button
        type={buttonType}
        onClick={buttonType === "button" ? props.clickEvent : undefined}
        className="bg-green-800 hover:bg-green-700 text-white font-bold py-2 px-4 rounded w-full transition"
      >
        {props.label}
      </button>
    </div>
  );
};

export default SubmitButton;
