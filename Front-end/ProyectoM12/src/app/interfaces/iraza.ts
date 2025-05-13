import { IManual } from "./imanual";

export interface IRaza {
    id: number;
    nom: string;
    descripcio: string;
    joc_id: number;
    manual: IManual;
}
