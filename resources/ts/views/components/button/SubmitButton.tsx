import React from "react";
import { USER_TYPE } from "../../../utils/enums/user/UserType";

interface PROPS {
  label: string;
  userType?: USER_TYPE;
  clickEvent?: () => Promise<void>;
}

const SubmitButton: React.FC<PROPS> = (props) => {
  const buttonType = props.clickEvent ? "button" : "submit";
  const buttonColor = props.userType === 1 ? "bg-blue-800" : "bg-green-800";
  const buttonHover =
    props.userType === 1 ? "hover:bg-blue-700" : "hover:bg-green-700";

  return (
    <div>
      <button
        type={buttonType}
        onClick={buttonType === "button" ? props.clickEvent : undefined}
        className={`${buttonColor} ${buttonHover} text-white font-bold py-2 px-4 rounded w-full transition`}
      >
        {props.label}
      </button>
    </div>
  );
};

export default SubmitButton;
