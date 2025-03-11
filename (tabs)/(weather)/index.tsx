import React from "react";
import { VStack } from "@/components/ui/vstack";
import {
  Wind,
  CloudRainWind,
  Waves,
  CloudRain,
  Sunrise,
  Sunset,
} from "lucide-react-native";
import { SunIcon, ClockIcon, Icon } from "@/components/ui/icon";
import { HStack } from "@/components/ui/hstack";
import HourlyCard from "@/components/screens/weather/hourly-card";
import { Box } from "@/components/ui/box";
import { Text } from "@/components/ui/text";
import ForeCastCard from "@/components/screens/weather/forecast-card";
import RainCard from "@/components/screens/weather/rain-card";
import Chart from "@/components/screens/weather/chart";

const hourlyCardList1 = [
  {
    id: 1,
    icon: Wind,
    text: "Wind speed",
    currentUpdate: "12km/h",
    lastUpdate: "2 km/h",
    arrowDownIcon: true,
    arrowUpIcon: false,
  },
  {
    id: 2,
    icon: CloudRainWind,
    text: "Rain chance",
    currentUpdate: "24%",
    lastUpdate: "10%",
    arrowDownIcon: false,
    arrowUpIcon: true,
  },
];

const hourlyCardList2 = [
  {
    id: 3,
    icon: Waves,
    text: "Pressure",
    currentUpdate: "720 hpa",
    lastUpdate: "32 hpa",
    arrowDownIcon: false,
    arrowUpIcon: true,
  },
  {
    id: 4,
    icon: SunIcon,
    text: "UV Index",
    currentUpdate: "2,3",
    lastUpdate: "0.3",
    arrowDownIcon: true,
    arrowUpIcon: false,
  },
];

const foreCastCardList = [
  {
    id: 1,
    time: "Now",
    imgUrl: require("../../../assets/images/sun_cloud.png"),
    temperature: 10,
  },
  {
    id: 2,
    time: "10 AM",
    imgUrl: require("../../../assets/images/cloud.png"),
    temperature: 8,
  },
  {
    id: 3,
    time: "11 AM",
    imgUrl: require("../../../assets/images/cloud.png"),
    temperature: 5,
  },
  {
    id: 4,
    time: "12 PM",
    imgUrl: require("../../../assets/images/sun_cloud.png"),
    temperature: 12,
  },
  {
    id: 5,
    time: "1 PM",
    imgUrl: require("../../../assets/images/sun_cloud.png"),
    temperature: 9,
  },

  {
    id: 6,
    time: "2 PM",
    imgUrl: require("../../../assets/images/cloud.png"),
    temperature: 12,
  },
];

const rainCardList = [
  {
    id: 1,
    time: 7,
    value: 27,
  },
  {
    id: 2,
    time: 8,
    value: 44,
  },
  {
    id: 3,
    time: 9,
    value: 56,
  },
  {
    id: 4,
    time: 10,
    value: 88,
  },
];

const hourlyCardList3 = [
  {
    id: 5,
    icon: Sunrise,
    text: "Sunrise",
    currentUpdate: "4:30 AM",
    lastUpdate: "4h ago",
  },
  {
    id: 6,
    icon: Sunset,
    text: "Sunset",
    currentUpdate: "6:50 PM",
    lastUpdate: "in 9h",
  },
];

const HourlyTab = () => {
  return (
    <VStack space="md" className="px-5 pb-5 bg-background-0">
      <VStack space="sm">
        <HStack space="sm">
          {hourlyCardList1.map((card: any) => {
            return (
              <HourlyCard
                key={card.id}
                icon={card.icon}
                text={card.text}
                currentUpdate={card.currentUpdate}
                lastUpdate={card.lastUpdate}
                arrowDownIcon={card.arrowDownIcon}
                arrowUpIcon={card.arrowUpIcon}
              />
            );
          })}
        </HStack>
        <HStack space="sm">
          {hourlyCardList2.map((card: any) => {
            return (
              <HourlyCard
                key={card.id}
                icon={card.icon}
                text={card.text}
                currentUpdate={card.currentUpdate}
                lastUpdate={card.lastUpdate}
                arrowDownIcon={card.arrowDownIcon}
                arrowUpIcon={card.arrowUpIcon}
              />
            );
          })}
        </HStack>
      </VStack>

      <VStack className="p-3 rounded-[18px] bg-background-100" space="md">
        <HStack space="sm" className="items-center">
          <Box className="h-8 w-8 bg-background-50 items-center justify-center rounded-full">
            <Icon as={ClockIcon} className="text-background-800" />
          </Box>
          <Text className="font-medium">Hourly forecast</Text>
        </HStack>

        <HStack className="justify-between px-3">
          {foreCastCardList.map((card: any) => {
            return (
              <ForeCastCard
                key={card.id}
                time={card.time}
                imgUrl={card.imgUrl}
                temperature={card.temperature}
              />
            );
          })}
        </HStack>
      </VStack>

      <Chart />

      <VStack className="p-3 rounded-[18px] bg-background-100" space="md">
        <HStack space="md" className="items-center">
          <Box className="h-8 w-8 bg-background-50 items-center justify-center rounded-full">
            <Icon as={CloudRain} className="text-background-800" />
          </Box>
          <Text className="font-medium">Chance of rain</Text>
        </HStack>

        <VStack className="justify-between px-3" space="md">
          {rainCardList.map((card: any) => {
            return (
              <RainCard key={card.id} time={card.time} value={card.value} />
            );
          })}
        </VStack>
      </VStack>

      <HStack space="sm">
        {hourlyCardList3.map((card: any) => {
          return (
            <HourlyCard
              key={card.id}
              icon={card.icon}
              text={card.text}
              currentUpdate={card.currentUpdate}
              lastUpdate={card.lastUpdate}
            />
          );
        })}
      </HStack>
    </VStack>
  );
};

export default HourlyTab;
