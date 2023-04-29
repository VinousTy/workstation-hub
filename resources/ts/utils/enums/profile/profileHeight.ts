// profileHeightのユニオン型を定義
export type PROFILE_HEIGHT = (typeof profileHeight)[keyof typeof profileHeight];

export const profileHeight = {
  SHORT_STATURE: 1,
  CENTIMETERS_150: 2,
  CENTIMETERS_155: 3,
  CENTIMETERS_160: 4,
  CENTIMETERS_165: 5,
  CENTIMETERS_170: 6,
  CENTIMETERS_175: 7,
  CENTIMETERS_180: 8,
  CENTIMETERS_185: 9,
  CENTIMETERS_190: 10,
  TALL_STATURE: 11,
} as const;

export const profileHeightSelect = [
  {
    label: "149㎝以下",
    value: profileHeight.SHORT_STATURE,
  },
  {
    label: "150㎝~154㎝",
    value: profileHeight.CENTIMETERS_150,
  },
  {
    label: "155㎝~159㎝",
    value: profileHeight.CENTIMETERS_155,
  },
  {
    label: "160㎝~164㎝",
    value: profileHeight.CENTIMETERS_160,
  },
  {
    label: "165㎝~169㎝",
    value: profileHeight.CENTIMETERS_165,
  },
  {
    label: "170㎝~174㎝",
    value: profileHeight.CENTIMETERS_170,
  },
  {
    label: "175㎝~179㎝",
    value: profileHeight.CENTIMETERS_175,
  },
  {
    label: "180㎝~184㎝",
    value: profileHeight.CENTIMETERS_180,
  },
  {
    label: "185㎝~189㎝",
    value: profileHeight.CENTIMETERS_185,
  },
  {
    label: "190㎝~194㎝",
    value: profileHeight.CENTIMETERS_190,
  },
  {
    label: "195㎝以上",
    value: profileHeight.TALL_STATURE,
  },
] as const;
