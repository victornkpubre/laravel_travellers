
import PlacesIndex from "./components/places/Index";
import PlacesEdit from "./components/places/Edit";
import PlacesCreate from "./components/places/Create";
import FestivalsIndex from "./components/festivals/Index";
import FestivalsEdit from "./components/festivals/Edit";
import FestivalsCreate from "./components/festivals/Create";
import ActivitiesIndex from "./components/activities/Index";
import ActivitiesEdit from "./components/activities/Edit";
import ActivitiesCreate from "./components/activities/Create";
import EmotionsIndex from "./components/emotions/Index";
import EmotionsEdit from "./components/emotions/Edit";
import EmotionsCreate from "./components/emotions/Create";
import UsersIndex from "./components/users/Index";
import UsersEdit from "./components/users/Edit";
import UsersCreate from "./components/users/Create";
import ClientsIndex from "./components/clients/Index";
import ClientsEdit from "./components/clients/Edit";
import ClientsCreate from "./components/clients/Create";
import BookingsIndex from "./components/bookings/Index";
import BookingsEdit from "./components/bookings/Edit";
import BookingsCreate from "./components/bookings/Create";


export const routes = [
    {
        path: "/places",
        name: "PlacesIndex",
        component: PlacesIndex
    },
    {
        path: "/places/create",
        name: "PlacesCreate",
        component: PlacesCreate
    },
    {
        path: "/places/:id",
        name: "PlacesEdit",
        component: PlacesEdit
    },
    {
        path: "/festivals",
        name: "FestivalsIndex",
        component: FestivalsIndex
    },
    {
        path: "/festivals/create",
        name: "FestivalsCreate",
        component: FestivalsCreate
    },
    {
        path: "/festivals/:id",
        name: "FestivalsEdit",
        component: FestivalsEdit
    },
    {
        path: "/activities",
        name: "ActivitiesIndex",
        component: ActivitiesIndex
    },
    {
        path: "/activities/create",
        name: "ActivitiesCreate",
        component: ActivitiesCreate
    },
    {
        path: "/activities/:id",
        name: "ActivitiesEdit",
        component: ActivitiesEdit
    },
    {
        path: "/emotions",
        name: "EmotionsIndex",
        component: EmotionsIndex
    },
    {
        path: "/emotions/create",
        name: "EmotionsCreate",
        component: EmotionsCreate
    },
    {
        path: "/emotions/:id",
        name: "EmotionsEdit",
        component: EmotionsEdit
    },
    {
        path: "/users",
        name: "UsersIndex",
        component: UsersIndex
    },
    {
        path: "/users/create",
        name: "UsersCreate",
        component: UsersCreate
    },
    {
        path: "/users/:id",
        name: "UsersEdit",
        component: UsersEdit
    },
    {
        path: "/clients",
        name: "ClientsIndex",
        component: ClientsIndex
    },
    {
        path: "/clients/create",
        name: "ClientsCreate",
        component: ClientsCreate
    },
    {
        path: "/clients/:id",
        name: "ClientsEdit",
        component: ClientsEdit
    },
    {
        path: "/bookings",
        name: "BookingsIndex",
        component: BookingsIndex
    },
    {
        path: "/bookings/create",
        name: "BookingsCreate",
        component: BookingsCreate
    },
    {
        path: "/bookings/:id",
        name: "BookingsEdit",
        component: BookingsEdit
    },


];
