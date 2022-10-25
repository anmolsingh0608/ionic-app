import { TokenData } from "./token_data.model";

export interface Token {
  // role: string;
  token: {
    token: TokenData;
    plainTextToken: string;
  };
  refreshToken: {
    token: TokenData;
    plainTextToken: string;
  };
}
