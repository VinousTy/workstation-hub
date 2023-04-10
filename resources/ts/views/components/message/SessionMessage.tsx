import React from "react";
import { SessionType } from "../../../utils/messageType";

interface PROPS {
  message: string;
  type: number;
  onClose: () => void;
}

const SessionMessage: React.FC<PROPS> = (props) => {
  const bgColor =
    props.type === SessionType.danger ? "bg-red-500" : "bg-green-500";

  return (
    <div className={`${bgColor} text-white py-3 px-4`}>
      <div className="flex justify-between items-center">
        <p className="text-sm font-medium">{props.message}</p>
        <button onClick={() => props.onClose()}>
          <svg
            className="w-4 h-4 fill-current"
            viewBox="0 0 20 20"
            xmlns="http://www.w3.org/2000/svg"
          >
            <path
              fillRule="evenodd"
              d="M14.142 14.142a1 1 0 01-1.414 0L10 11.414l-2.828 2.828a1 1 0 01-1.414-1.414L8.586 10 5.757 7.172a1 1 0 111.414-1.414L10 8.586l2.828-2.828a1 1 0 111.414 1.414L11.414 10l2.828 2.828z"
              clipRule="evenodd"
            />
          </svg>
        </button>
      </div>
    </div>
  );
};

export default SessionMessage;
