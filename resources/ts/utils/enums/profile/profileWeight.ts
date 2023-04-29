// profileWeightのユニオン型を定義
export type PROFILE_WEIGHT = (typeof profileWeight)[keyof typeof profileWeight];

export const profileWeight = {
  LIGHT_WEIGHT: 1,
  KILOGRAM_40: 2,
  KILOGRAM_45: 3,
  KILOGRAM_50: 4,
  KILOGRAM_55: 5,
  KILOGRAM_60: 6,
  KILOGRAM_65: 7,
  KILOGRAM_70: 8,
  KILOGRAM_75: 9,
  KILOGRAM_80: 10,
  KILOGRAM_85: 11,
  KILOGRAM_90: 12,
  KILOGRAM_95: 13,
  HEAVY_WEIGHT: 14,
} as const;

export const profileWeightSelect = [
  {
    label: "39kg以下",
    value: profileWeight.LIGHT_WEIGHT,
  },
  {
    label: "40kg~44kg",
    value: profileWeight.KILOGRAM_40,
  },
  {
    label: "45kg~49kg",
    value: profileWeight.KILOGRAM_45,
  },
  {
    label: "50kg~54kg",
    value: profileWeight.KILOGRAM_50,
  },
  {
    label: "55kg~59kg",
    value: profileWeight.KILOGRAM_55,
  },
  {
    label: "60kg~64kg",
    value: profileWeight.KILOGRAM_60,
  },
  {
    label: "65kg~69kg",
    value: profileWeight.KILOGRAM_65,
  },
  {
    label: "70kg~74kg",
    value: profileWeight.KILOGRAM_70,
  },
  {
    label: "75kg~79kg",
    value: profileWeight.KILOGRAM_75,
  },
  {
    label: "80kg~84kg",
    value: profileWeight.KILOGRAM_80,
  },
  {
    label: "85kg~89kg",
    value: profileWeight.KILOGRAM_85,
  },
  {
    label: "90kg~94kg",
    value: profileWeight.KILOGRAM_90,
  },
  {
    label: "95kg~99kg",
    value: profileWeight.KILOGRAM_95,
  },
  {
    label: "100kg以上",
    value: profileWeight.LIGHT_WEIGHT,
  },
] as const;
