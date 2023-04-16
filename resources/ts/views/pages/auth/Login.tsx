import React, { useCallback, useEffect, useState } from "react";
import { useSelector } from "react-redux";
import { useDispatch } from "react-redux";
import { useNavigate } from "react-router-dom";
import {
  closeMessage,
  selectMessage,
  userLogin,
} from "../../../features/auth/authSlice";
import { AppDispatch, persistConfig } from "../../../features/store";
import SubmitButton from "../../components/button/SubmitButton";
import InputForm from "../../components/form/InputForm";
import loginImage from "../../../assets/auth/login-bro.jpg";
import SessionMessage from "../../components/message/SessionMessage";
import { SessionType } from "../../../utils/messageType";

const Login = () => {
  const [email, setEmail] = useState("");
  const [password, setPassword] = useState("");
  const [errors, setErrors] = useState({
    name: [],
    email: [],
    password: [],
  });
  const dispatch: AppDispatch = useDispatch();
  const message = useSelector(selectMessage);
  const navigate = useNavigate();
  const presistKey = persistConfig.key;

  const changedEmail = useCallback(
    (e: React.ChangeEvent<HTMLInputElement>) => {
      setEmail(e.target.value);
    },
    [setEmail]
  );

  const changedPassword = useCallback(
    (e: React.ChangeEvent<HTMLInputElement>) => {
      setPassword(e.target.value);
    },
    [setPassword]
  );

  const handleCloseMessage = useCallback(() => {
    dispatch(closeMessage());
    sessionStorage.removeItem(presistKey);
  }, []);

  const handleSubmit = async (e: React.SyntheticEvent) => {
    e.preventDefault();

    await dispatch(
      userLogin({
        email: email,
        password: password,
      })
    )
      .unwrap()
      .then((res) => {
        navigate("/mypage");
      })
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
          ログイン
        </h1>
        <form method="post" onSubmit={handleSubmit}>
          <InputForm
            label="メールアドレス"
            value={email}
            type="email"
            onChange={changedEmail}
            errorMessage={errors.email}
          />
          <InputForm
            label="パスワード"
            value={password}
            type="password"
            onChange={changedPassword}
            errorMessage={errors.password}
          />
          {errors.name && (
            <p className="text-red-500 text-sm font-bold">{errors?.name[0]}</p>
          )}
          <div className="flex flex-col items-center">
            <div className="flex items-center mb-4">
              <input
                type="checkbox"
                name="remember"
                id="remember"
                className="mr-2"
              />
              <label htmlFor="remember" className="text-gray-400 font-bold">
                ログイン情報を保存する
              </label>
            </div>
            <p
              className="text-blue-500 font-bold hover:text-blue-700 mb-4 cursor-pointer"
              onClick={() => navigate("/forgot/password")}
            >
              パスワードをお忘れですか？
            </p>
          </div>
          <SubmitButton label="ログイン" />
          <div className="mt-4 text-center flex items-center">
            <hr className="flex-1 border-t-2 border-gray-300" />
            <span className="text-gray-500 font-bold mx-2">または</span>
            <hr className="flex-1 border-t-2 border-gray-300" />
          </div>
          <div className="flex flex-col space-y-2 mt-4">
            <button
              type="button"
              className="bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-4 rounded"
            >
              <i className="fab fa-google mr-2"></i>
              Googleでログイン
            </button>
          </div>
        </form>
        <p
          className="text-gray-400 text-center mt-8 cursor-pointer hover:text-gray-200 transition"
          onClick={() => navigate("/register")}
        >
          新規アカウントを作成する
        </p>
      </div>
    </div>
  );
};

export default Login;
