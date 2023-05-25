export const changeFile = (
  file: File | null,
  setPreviewImage: React.Dispatch<React.SetStateAction<string | null>>
) => {
  if (file) {
    const reader = new FileReader();
    reader.onloadend = () => {
      setPreviewImage(reader.result as string);
    };
    reader.readAsDataURL(file);
  } else {
    setPreviewImage(null);
  }
};
