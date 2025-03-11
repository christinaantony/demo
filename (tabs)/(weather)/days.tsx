import React from "react";
import { VStack } from "@/components/ui/vstack";
import DaysCard from "@/components/screens/weather/days-card";

const daysCardList = [
  {
    id: 1,
    day: "Today",
    weather: "Cloudy and Sunny",
    highest: 3,
    lowest: -2,
    imgUrl: require("../../../assets/images/sun_cloud.png"),
  },
  {
    id: 2,
    day: "Thursday, Jan 19",
    weather: "Cloudy",
    highest: 3,
    lowest: -2,
    imgUrl: require("../../../assets/images/cloud.png"),
  },
  {
    id: 3,
    day: "Friday, Jan 20",
    weather: "Sunny",
    highest: 3,
    lowest: -2,
    imgUrl: require("../../../assets/images/sun_cloud.png"),
  },
  {
    id: 4,
    day: "Saturday, Jan 21",
    weather: "Cloudy",
    highest: 3,
    lowest: -2,
    imgUrl: require("../../../assets/images/cloud.png"),
  },
  {
    id: 5,
    day: "Saturday, Jan 21",
    weather: "Cloudy",
    highest: 3,
    lowest: -2,
    imgUrl: require("../../../assets/images/cloud.png"),
  },
  {
    id: 6,
    day: "Saturday, Jan 21",
    weather: "Cloudy",
    highest: 3,
    lowest: -2,
    imgUrl: require("../../../assets/images/cloud.png"),
  },
  {
    id: 7,
    day: "Saturday, Jan 21",
    weather: "Cloudy",
    highest: 3,
    lowest: -2,
    imgUrl: require("../../../assets/images/sun_cloud.png"),
  },
  {
    id: 8,
    day: "Saturday, Jan 21",
    weather: "Cloudy",
    highest: 3,
    lowest: -2,
    imgUrl: require("../../../assets/images/sun_cloud.png"),
  },
  {
    id: 9,
    day: "Saturday, Jan 21",
    weather: "Cloudy",
    highest: 3,
    lowest: -2,
    imgUrl: require("../../../assets/images/cloud.png"),
  },
  {
    id: 10,
    day: "Saturday, Jan 21",
    weather: "Cloudy",
    highest: 3,
    lowest: -2,
    imgUrl: require("../../../assets/images/sun_cloud.png"),
  },
];

const days = () => {
  return (
    <VStack space="md" className="px-5 pb-5">
      {daysCardList.map((card: any) => {
        return (
          <DaysCard
            key={card.id}
            day={card.day}
            weather={card.weather}
            highest={card.highest}
            lowest={card.lowest}
            imgUrl={card.imgUrl}
          />
        );
      })}
    </VStack>
  );
};

export default days;
