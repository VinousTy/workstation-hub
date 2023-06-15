import React, { useCallback, useEffect, useState } from "react";
import loginImage from "../../../../assets/auth/login-bro.jpg";
import {
  changePassword,
  selectMessage,
} from "../../../../features/user/auth/authSlice";
import { AppDispatch, persistConfig } from "../../../../features/store";
import { useDispatch } from "react-redux";
import { useSelector } from "react-redux";
import SessionMessage from "../../../components/message/SessionMessage";
import { MessageClass, SessionType } from "../../../../utils/messageType";
import InputForm from "../../../components/form/InputForm";
import SubmitButton from "../../../components/button/SubmitButton";
import { inputPlaceholder } from "../../../../utils/lang";

const PasswordSettings = () => {
  const [password, setPassword] = useState("");
  const [passwordConfirm, setPasswordConfirm] = useState("");
  const [errors, setErrors] = useState({
    password: [],
  });
  const dispatch: AppDispatch = useDispatch();
  const message = useSelector(selectMessage);
  const presistKey = persistConfig.key;

  const changedPassword = useCallback(
    (e: React.ChangeEvent<HTMLInputElement>) => {
      setPassword(e.target.value);
    },
    [setPassword]
  );

  const changedPasswordConfirm = useCallback(
    (e: React.ChangeEvent<HTMLInputElement>) => {
      setPasswordConfirm(e.target.value);
    },
    [setPasswordConfirm]
  );

  const handleSubmit = async (e: React.SyntheticEvent) => {
    e.preventDefault();

    await dispatch(
      changePassword({
        password: password,
        passwordConfirmation: passwordConfirm,
      })
    )
      .unwrap()
      .then((res) => {
        setPassword("");
        setPasswordConfirm("");
      })
      .catch((error) => {
        setErrors(error);
      });
  };

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
      {message !== "" && message !== undefined && (
        <div className="absolute mx-auto md:top-20 max-w-md">
          <SessionMessage
            message={message}
            type={SessionType.success}
            class={MessageClass.user}
          />
        </div>
      )}
      <div className="bg-opacity-black p-8 rounded shadow-md max-w-md w-full">
        <h1 className="text-2xl text-gray-300 font-bold mb-6 text-center">
          パスワード変更
        </h1>
        <div className="text-gray-300 mb-4">
          <p>変更したいパスワードを入力してください。</p>
        </div>
        <form method="post" onSubmit={handleSubmit}>
          <InputForm
            label="新規パスワード"
            value={password}
            type="password"
            onChange={changedPassword}
            errorMessage={errors.password}
            placeHolderText={inputPlaceholder.password}
          />
          <InputForm
            label="パスワード（確認用）"
            value={passwordConfirm}
            type="password"
            onChange={changedPasswordConfirm}
            errorMessage={errors.password}
            placeHolderText={inputPlaceholder.passwordConfirm}
          />
          <div className="mt-8">
            <SubmitButton label="パスワード変更" />
          </div>
        </form>
      </div>
    </div>
  );
};

export default PasswordSettings;
