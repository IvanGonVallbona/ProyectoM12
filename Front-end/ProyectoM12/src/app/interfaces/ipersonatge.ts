import { ICampanya } from "./icampanya";
import { IClasse } from "./iclasse";
import { IManual } from "./imanual";
import { IRaza } from "./iraza";
import { IUser } from "./iuser";

export interface IPersonatge {
    id: number;
    nom: string;
    nivell: number;
    classe_id: IClasse | number | null;
    raza_id: IRaza | number | null;
    user_id: IUser | number | null;
    campanya_id: ICampanya | number | null;
    joc_id: IManual | number | null;
    imatge: string | null;
}
