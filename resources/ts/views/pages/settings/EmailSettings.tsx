import React, { useCallback, useEffect, useState } from "react";
import InputForm from "../../components/form/InputForm";
import SubmitButton from "../../components/button/SubmitButton";
import loginImage from "../../../assets/auth/login-bro.jpg";
import SessionMessage from "../../components/message/SessionMessage";
import { SessionType } from "../../../utils/messageType";
import { AppDispatch, persistConfig } from "../../../features/store";
import { useDispatch } from "react-redux";
import { useSelector } from "react-redux";
import {
  changeEmail,
  closeMessage,
  selectMessage,
} from "../../../features/auth/authSlice";
import { inputPlaceholder } from "../../../utils/lang";

const EmailSettings = () => {
  const [email, setEmail] = useState("");
  const [errors, setErrors] = useState({
    email: [],
  });
  const dispatch: AppDispatch = useDispatch();
  const message = useSelector(selectMessage);
  const presistKey = persistConfig.key;

  const changedEmail = useCallback(
    (e: React.ChangeEvent<HTMLInputElement>) => {
      setEmail(e.target.value);
    },
    [setEmail]
  );

  const handleCloseMessage = useCallback(() => {
    dispatch(closeMessage());
    sessionStorage.removeItem(presistKey);
  }, []);

  const handleSubmit = async (e: React.SyntheticEvent) => {
    e.preventDefault();

    await dispatch(
      changeEmail({
        email: email,
      })
    )
      .unwrap()
      .catch((error) => {
        setErrors(error);
      });
  };

  useEffect(() => {
    const timeoutId = setTimeout(() => {
      dispatch(closeMessage());
      sessionStorage.removeItem(presistKey);
    }, 5000);

    return () => clearTimeout(timeoutId);
  }, [message]);

  return (
    <div
      className="min-h-screen flex items-center justify-center bg-cover bg-center bg-no-repeat bg-gradient-to-br from-blue-500 to-indigo-500 before:bg-opacity-black before:bg-inherit before:backdrop-filter before:backdrop-blur-lg before:absolute before:-top-5 before:-left-5 before:-right-5 before:-bottom-5 before:z-[-1]"
      style={{
        backgroundImage: ` linear-gradient(
        rgba(32, 32, 32, 0.6),
        rgba(32, 32, 32, 0.6)
      ), url(${loginImage})`,
      }}
    >
      {message !== "" && (
        <div className="absolute mx-auto md:top-20 max-w-md">
          <SessionMessage
            message={message}
            type={SessionType.success}
            onClose={handleCloseMessage}
          />
        </div>
      )}
      <div className="bg-opacity-black p-8 rounded shadow-md max-w-md w-full">
        <h1 className="text-2xl text-gray-300 font-bold mb-6 text-center">
          メールアドレス変更
        </h1>
        <div className="text-gray-300 mb-4">
          <p>変更したいメールアドレスを入力してください。</p>
        </div>
        <form method="post" onSubmit={handleSubmit}>
          <InputForm
            label="新規メールアドレス"
            value={email}
            type="email"
            onChange={changedEmail}
            errorMessage={errors.email}
            placeHolderText={inputPlaceholder.email}
          />
          <div className="mt-8">
            <SubmitButton label="メールアドレス変更" />
          </div>
        </form>
      </div>
    </div>
  );
};

export default EmailSettings;
