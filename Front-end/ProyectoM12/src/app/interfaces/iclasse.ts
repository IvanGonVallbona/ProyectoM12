import { IManual } from "./imanual";
export interface IClasse {
    id: number;
    nom: string;
    descripcio: string;
    joc_id: number;
    manual: IManual
}
