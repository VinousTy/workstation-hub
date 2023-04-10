import React, { useCallback, useState } from "react";
import { useLocation, useNavigate } from "react-router-dom";
import SubmitButton from "../../components/button/SubmitButton";
import InputForm from "../../components/form/InputForm";
import loginImage from "../../../assets/auth/login-bro.jpg";
import { AppDispatch } from "../../../features/store";
import { useDispatch } from "react-redux";
import { resetPassword } from "../../../features/auth/authSlice";
import SessionMessage from "../../components/message/SessionMessage";
import { SessionType } from "../../../utils/messageType";

const ResetPassword = () => {
  const [password, setPassword] = useState("");
  const [passwordConfirm, setPasswordConfirm] = useState("");
  const [message, setMessage] = useState("");
  const [messageType, setMessageType] = useState(0);
  const [errors, setErrors] = useState({
    token: [],
    password: [],
  });
  const dispatch: AppDispatch = useDispatch();
  const navigate = useNavigate();
  const location = useLocation();
  const searchParams = new URLSearchParams(location.search);
  const token = searchParams.get("token");
  const email = searchParams.get("email");

  const changedPassword = useCallback(
    (e: React.ChangeEvent<HTMLInputElement>) => {
      setPassword(e.target.value);
    },
    []
  );

  const changedPasswordConfirm = useCallback(
    (e: React.ChangeEvent<HTMLInputElement>) => {
      setPasswordConfirm(e.target.value);
    },
    [setPassword]
  );

  const handleCloseMessage = useCallback(() => {
    setMessage("");
  }, []);

  const handleSubmit = async (e: React.SyntheticEvent) => {
    e.preventDefault();

    setPassword("");
    setPasswordConfirm("");

    await dispatch(
      resetPassword({
        email: email,
        password: password,
        passwordConfirmation: passwordConfirm,
        token: token,
      })
    )
      .unwrap()
      .then((res) => {
        navigate("/reset-password/compalate");
      })
      .catch((error) => {
        if (typeof error === "string") {
          setMessage(error);
          setMessageType(SessionType.danger);
        } else {
          setErrors(error);
          setMessageType(SessionType.danger);
        }
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
      {message !== "" && (
        <div className="absolute mx-auto md:top-28 max-w-md">
          <SessionMessage
            message={message}
            type={SessionType.danger}
            onClose={handleCloseMessage}
          />
        </div>
      )}
      <div className="bg-opacity-black p-8 rounded shadow-md max-w-md w-full">
        <h1 className="text-2xl font-bold mb-6 text-center  text-gray-300">
          パスワード再発行
        </h1>
        <p className="text-left text-xl mb-4  text-gray-300">
          新しく登録したいパスワードを入力してください。
        </p>
        <form method="post" onSubmit={handleSubmit}>
          <InputForm
            label="新規パスワード"
            value={password}
            type="password"
            onChange={changedPassword}
            errorMessage={errors.password}
          />
          <InputForm
            label="パスワード（確認用）"
            value={passwordConfirm}
            type="password"
            onChange={changedPasswordConfirm}
            errorMessage={errors.password}
          />
          <div className="mb-4">
            <p className="text-left text-gray-400">
              入力が完了しましたら、送信ボタンをクリックしてください。
            </p>
          </div>
          <SubmitButton label="送信" />
        </form>
      </div>
    </div>
  );
};

export default ResetPassword;
