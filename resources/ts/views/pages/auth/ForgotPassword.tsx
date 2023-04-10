import React, { useCallback, useState } from "react";
import { useDispatch } from "react-redux";
import { useNavigate } from "react-router-dom";
import { forgotPassword } from "../../../features/auth/authSlice";
import { AppDispatch } from "../../../features/store";
import loginImage from "../../../assets/auth/login-bro.jpg";
import { SessionType } from "../../../utils/messageType";
import SubmitButton from "../../components/button/SubmitButton";
import InputForm from "../../components/form/InputForm";
import SessionMessage from "../../components/message/SessionMessage";

const ForgotPassword = () => {
  const [email, setEmail] = useState("");
  const [errors, setErrors] = useState({
    email: [],
  });
  const [message, setMessage] = useState("");
  const dispatch: AppDispatch = useDispatch();
  const navigate = useNavigate();

  const changedEmail = useCallback(
    (e: React.ChangeEvent<HTMLInputElement>) => {
      setEmail(e.target.value);
    },
    [setEmail]
  );

  const handleCloseMessage = useCallback(() => {
    setMessage("");
  }, []);

  const handleSubmit = async (e: React.SyntheticEvent) => {
    e.preventDefault();

    await dispatch(
      forgotPassword({
        email: email,
      })
    )
      .unwrap()
      .then((res) => {
        navigate("compalate");
      })
      .catch((error) => {
        if (typeof error === "string") {
          setMessage(error);
        } else {
          setErrors(error);
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
      <div className="bg-opacity-black p-8 rounded shadow-md max-w-md w-full text-gray-300">
        <h1 className="text-2xl font-bold mb-6 text-center">
          パスワード再発行
        </h1>
        <p className="text-left text-xl mb-4">
          メールアドレスを入力してください。
        </p>
        <form method="post" onSubmit={handleSubmit}>
          <InputForm
            label="メールアドレス"
            value={email}
            type="email"
            onChange={changedEmail}
            errorMessage={errors.email}
          />
          <div className="mb-4">
            <p className="text-left text-gray-400">
              ご登録されているメールアドレスに再設定メールを送信します。
            </p>
            <p className="text-left text-gray-400">
              メールアドレスをお忘れの場合は、お手数ですが、
              <span
                className="text-blue-500 font-bold hover:text-blue-700 mb-4 cursor-pointer"
                onClick={() => navigate("/contact")}
              >
                ヘルプデスク
              </span>
              にお問い合わせください。
            </p>
          </div>
          <SubmitButton label="送信" />
        </form>
        <p
          className="text-gray-400 text-center mt-8 cursor-pointer hover:text-gray-200 transition"
          onClick={() => navigate("/login")}
        >
          ログイン画面へ
        </p>
      </div>
    </div>
  );
};

export default ForgotPassword;
