import React, { useCallback, useEffect, useState } from "react";
import { useNavigate } from "react-router-dom";
import SettingsItem from "../../components/settings/SettingsItem";
import InputForm from "../../components/form/InputForm";
import { inputPlaceholder } from "../../../utils/lang";
import TextArea from "../../components/form/TextArea";
import SelectBox from "../../components/form/SelectBox";
import { profileHeightSelect } from "../../../utils/enums/profile/profileHeight";
import { profileWeightSelect } from "../../../utils/enums/profile/profileWeight";
import { AppDispatch } from "../../../features/store";
import { useDispatch } from "react-redux";
import {
  getProfile,
  selectProfile,
} from "../../../features/profile/profileSlice";
import { useSelector } from "react-redux";
import SubmitButton from "../../components/button/SubmitButton";

const ProfileSettings = () => {
  const navigate = useNavigate();
  const dispatch: AppDispatch = useDispatch();
  const profileData = useSelector(selectProfile);
  const [filePath, setFilePath] = useState("");
  const [height, setHeight] = useState(0);
  const [weight, setWeight] = useState(0);
  const [account, setAccount] = useState("");
  const [introduction, setIntroduction] = useState("");
  const [errors, setErrors] = useState({
    height: [],
    weight: [],
    account: [],
    introduction: [],
  });

  const changedHeight = useCallback(
    (e: React.ChangeEvent<HTMLSelectElement>) => {
      setHeight(Number(e.target.value));
    },
    [setHeight]
  );

  const changedWeight = useCallback(
    (e: React.ChangeEvent<HTMLSelectElement>) => {
      setWeight(Number(e.target.value));
    },
    [setWeight]
  );

  const changedAccount = useCallback(
    (e: React.ChangeEvent<HTMLInputElement>) => {
      setAccount(e.target.value);
    },
    [setAccount]
  );

  const changedIntroduction = useCallback(
    (e: React.ChangeEvent<HTMLTextAreaElement>) => {
      setIntroduction(e.target.value);
    },
    [setIntroduction]
  );

  useEffect(() => {
    const fetchProfile = async () => {
      await dispatch(getProfile())
        // Promiseが成功した場合に値を解決し、失敗した場合にはエラーをスロー
        .unwrap()
        .then((res) => {
          setFilePath(profileData?.profile.filePath);
          setHeight(profileData?.profile.height);
          setWeight(profileData?.profile.weight);
          setAccount(profileData?.profile.account);
          setIntroduction(profileData?.profile.introduction);
        })
        .catch((error) => {
          setErrors(error);
        });
    };

    fetchProfile();
  }, [dispatch]);

  return (
    <div className="bg-application-all min-h-screen">
      <div className="max-w-5xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
        <h1 className="text-2xl font-semibold text-gray-300 mb-8">
          プロフィール設定
        </h1>
        <div className="flex">
          <SettingsItem />
          <div className="w-2/3 bg-opacity-black">
            <div className="shadow overflow-hidden sm:rounded-lg">
              <div className="px-4 py-5 sm:px-6">
                <h2 className="text-lg leading-6 font-medium text-gray-300">
                  プロフィール設定
                </h2>
                <p className="mt-1 max-w-2xl text-sm text-gray-500">
                  下記のフォームに必要事項をご入力ください。
                </p>
              </div>
              <div className="border-t border-gray-200">
                <div className="px-4 py-5 sm:p-6">
                  <div className="grid grid-cols-6 gap-6">
                    <div className="col-span-6 sm:col-span-4">
                      <label
                        htmlFor="profile-image"
                        className="block text-sm font-medium text-gray-300"
                      >
                        プロフィール画像
                      </label>
                      <div className="mt-1 flex items-center">
                        {filePath ? (
                          <img
                            src={filePath}
                            alt="プロフィール画像"
                            className="h-12 w-12 rounded-full object-cover mr-8"
                          />
                        ) : (
                          <span className="inline-block h-12 w-12 rounded-full overflow-hidden bg-gray-100 mr-8">
                            <svg
                              className="h-full w-full text-gray-300"
                              fill="currentColor"
                              viewBox="0 0 24 24"
                            >
                              <path
                                fillRule="evenodd"
                                d="M12 4a4 4 0 100 8 4 4 0 000-8zm0 6a2 2 0 11.001-3.999A2 2 0 0112 10zm7.071 6.071a10 10 0 01-14.142 0A8 8 0 1012 20a8 8 0 017.071-13.929z"
                                clipRule="evenodd"
                              />
                            </svg>
                          </span>
                        )}
                        <span className="rounded-md shadow-sm">
                          <button
                            type="button"
                            className="inline-flex items-center px-3 py-1.5 border border-gray-300 leading-5 font-medium rounded-md text-gray-300 hover:text-white focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition"
                          >
                            画像を変更する
                          </button>
                        </span>
                      </div>
                    </div>
                    <div className="col-span-6">
                      <SelectBox
                        label="身長"
                        value={height}
                        type="height"
                        optional={profileHeightSelect}
                        onChange={changedHeight}
                        errorMessage={errors.height}
                        placeHolderText={inputPlaceholder.select}
                      />
                      <SelectBox
                        label="体重"
                        value={weight}
                        type="weight"
                        optional={profileWeightSelect}
                        onChange={changedWeight}
                        errorMessage={errors.weight}
                        placeHolderText={inputPlaceholder.select}
                      />
                      <InputForm
                        label="SNSリンク"
                        value={account}
                        type="account"
                        onChange={changedAccount}
                        errorMessage={errors.account}
                        placeHolderText={inputPlaceholder.account}
                      />
                    </div>
                    <div className="col-span-6">
                      <TextArea
                        label="自己紹介"
                        value={introduction}
                        type="introduction"
                        row={3}
                        onChange={changedIntroduction}
                        errorMessage={errors.introduction}
                        placeHolderText={inputPlaceholder.introduction}
                      />
                    </div>
                  </div>
                  <div className="mt-6">
                    <SubmitButton label="更新する" />
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  );
};

export default ProfileSettings;
