export function convertToCamelCase<T>(obj: T): T {
  if (typeof obj !== "object" || obj === null) {
    return obj;
  }

  if (Array.isArray(obj)) {
    return obj.map((item) => convertToCamelCase(item)) as any;
  }

  const converted = {} as T;
  for (const key in obj) {
    if (Object.prototype.hasOwnProperty.call(obj, key)) {
      const camelCaseKey = key.replace(/_([a-z])/g, (_, letter) =>
        letter.toUpperCase()
      ) as keyof T;
      converted[camelCaseKey] = convertToCamelCase(obj[key]);
    }
  }

  return converted;
}
