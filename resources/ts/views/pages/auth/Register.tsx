import React, { useCallback, useState } from "react";
import { useDispatch } from "react-redux";
import { useNavigate } from "react-router-dom";
import { userRegister } from "../../../features/auth/authSlice";
import { AppDispatch } from "../../../features/store";
import SubmitButton from "../../components/button/SubmitButton";
import InputForm from "../../components/form/InputForm";
import loginImage from "../../../assets/auth/login-bro.jpg";

const Register = () => {
  const [email, setEmail] = useState("");
  const [password, setPassword] = useState("");
  const [passwordConfirm, setPasswordConfirm] = useState("");
  const [errors, setErrors] = useState({
    name: [],
    email: [],
    password: [],
  });
  const dispatch: AppDispatch = useDispatch();
  const navigate = useNavigate();

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

  const changedPasswordConfirm = useCallback(
    (e: React.ChangeEvent<HTMLInputElement>) => {
      setPasswordConfirm(e.target.value);
    },
    [setPasswordConfirm]
  );

  const handleSubmit = async (e: React.SyntheticEvent) => {
    e.preventDefault();

    await dispatch(
      userRegister({
        email: email,
        password: password,
        passwordConfirmation: passwordConfirm,
      })
    )
      .unwrap()
      .then((res) => {
        navigate("/verify/email");
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
      <div className="bg-opacity-black p-8 rounded shadow-md max-w-md w-full">
        <h1 className="text-2xl text-gray-300 font-bold mb-6 text-center">
          ユーザー登録
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
          <InputForm
            label="パスワード（確認用）"
            value={passwordConfirm}
            type="password"
            onChange={changedPasswordConfirm}
            errorMessage={errors.password}
          />
          {errors.name && (
            <p className="text-red-500 text-sm font-bold">{errors?.name[0]}</p>
          )}
          <div className="pt-6">
            <SubmitButton label="新規登録" />
          </div>
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
              Googleで登録
            </button>
          </div>
        </form>
        <p
          className="text-gray-400 text-center mt-8 cursor-pointer hover:text-gray-200 transition"
          onClick={() => navigate("/login")}
        >
          ログインはこちらから
        </p>
      </div>
    </div>
  );
};

export default Register;
