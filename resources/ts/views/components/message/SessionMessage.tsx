import React, { useCallback, useEffect } from "react";
import { MessageClass, SessionType } from "../../../utils/messageType";
import { AppDispatch, persistConfig } from "../../../features/store";
import { useDispatch } from "react-redux";
import {
  closeUserMessage,
  selectMessage,
} from "../../../features/auth/authSlice";
import {
  closeProfileMessage,
  selectMessage as selectProfileMessage,
} from "../../../features/profile/profileSlice";
import { useSelector } from "react-redux";
import {
  closeDeskMessage,
  selectDeskMessage,
} from "../../../features/desk/deskSlice";

interface PROPS {
  message: string;
  type: number;
  class: number;
}

const SessionMessage: React.FC<PROPS> = (props) => {
  const dispatch: AppDispatch = useDispatch();
  const userMessage = useSelector(selectMessage);
  const profileMessage = useSelector(selectProfileMessage);
  const deskMessage = useSelector(selectDeskMessage);
  const presistKey = persistConfig.key;

  const displayMessage = useCallback(() => {
    switch (props.class) {
      case MessageClass.user:
        return userMessage;
      case MessageClass.profile:
        return profileMessage;
      case MessageClass.desk:
        return deskMessage;
      default:
        return "エラーが発生しました。";
    }
  }, []);

  const bgColor =
    props.type === SessionType.danger ? "bg-red-500" : "bg-green-500";

  const handleCloseMessage = useCallback(() => {
    switch (props.class) {
      case MessageClass.user:
        dispatch(closeUserMessage());
        sessionStorage.removeItem(presistKey);
      case MessageClass.profile:
        dispatch(closeProfileMessage());
        sessionStorage.removeItem(presistKey);
      case MessageClass.desk:
        console.log(sessionStorage);
        dispatch(closeDeskMessage());
        sessionStorage.removeItem(presistKey);
      default:
        dispatch(closeUserMessage());
        dispatch(closeProfileMessage());
        dispatch(closeDeskMessage());
        sessionStorage.removeItem(presistKey);
    }
  }, []);

  useEffect(() => {
    const timeoutId = setTimeout(() => {
      switch (props.class) {
        case MessageClass.user:
          dispatch(closeUserMessage());
          sessionStorage.removeItem(presistKey);
        case MessageClass.profile:
          dispatch(closeProfileMessage());
          sessionStorage.removeItem(presistKey);
        case MessageClass.desk:
          dispatch(closeDeskMessage());
          sessionStorage.removeItem(presistKey);
        default:
          dispatch(closeUserMessage());
          dispatch(closeProfileMessage());
          dispatch(closeDeskMessage());
          sessionStorage.removeItem(presistKey);
      }
    }, 5000);

    return () => clearTimeout(timeoutId);
  }, [userMessage, profileMessage, deskMessage]);

  return (
    <div className={`${bgColor} text-white py-3 px-4`}>
      <div className="flex justify-between items-center">
        <p className="text-sm font-medium">{displayMessage()}</p>
        <button onClick={() => handleCloseMessage()}>
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
