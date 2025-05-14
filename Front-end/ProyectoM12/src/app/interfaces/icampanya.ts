import { IManual } from "./imanual";
import { IUser } from "./iuser";

export interface ICampanya {
    id: number;
    nom: string;
    descripcio: string;
    estat: string;
    user_id: IUser;
    joc_id: IManual;
    personatges: number;
}
