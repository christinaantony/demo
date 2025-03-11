import React, { useContext, useState } from "react";
import { Text } from "@/components/ui/text";
import { VStack } from "@/components/ui/vstack";
import LocationCard from "@/components/screens/location/location-card";
import { Input, InputSlot, InputIcon, InputField } from "@/components/ui/input";
import { SearchIcon } from "@/components/ui/icon";
import { Mic } from "lucide-react-native";
import { LinearGradient } from "@/components/ui/linear-gradient";
import { HStack } from "@/components/ui/hstack";
import { Image } from "@/components/ui/image";
import { ColorModeContext } from "@/app/_layout";
import { ScrollView } from "@/components/ui/scroll-view";

const locationCardList = [
  {
    id: 1,
    country: "My Location",
    time: "Bengaluru",
    temperature: 32,
    weather: "Rainy",
    AQI: 100,
    wind: "Light",
    highest: 35,
    lowest: -23,
  },
  {
    id: 2,
    country: "New York",
    time: "10:20 AM",
    temperature: 12,
    weather: "Sunny",
    AQI: 80,
    wind: "Light",
    highest: 16,
    lowest: -2,
  },
  {
    id: 3,
    country: "Taiwan",
    time: "02:15 PM",
    temperature: 35,
    weather: "Humid",
    AQI: 120,
    wind: "Light",
    highest: 40,
    lowest: 33,
  },
  {
    id: 4,
    country: "Tokyo",
    time: "10:45 PM",
    temperature: 10,
    weather: "Rainy",
    AQI: 50,
    wind: "Light",
    highest: 15,
    lowest: -8,
  },
];

const Location = () => {
  const { colorMode }: any = useContext(ColorModeContext);
  const [selectedCard, setSelectedCard] = useState<number>(1);
  return (
    <VStack space="md" className="flex-1 bg-background-0">
      <LinearGradient
        colors={
          colorMode === "light"
            ? ["#D288F0", "#CCADFF"]
            : ["#080D4F", "#2C1566"]
        }
        className="rounded-b-[33px]"
      >
        <VStack
          className="ios:h-[269px] h-[249px] py-6 px-5 justify-end"
          space="2xl"
        >
          <HStack className="justify-between items-start px-2">
            <Text size="2xl" className="text-typography-900 font-semibold">
              Location
            </Text>
            <VStack className="items-center">
              <Image
                source={
                  colorMode === "light"
                    ? require("../../assets/images/light-palace.png")
                    : require("../../assets/images/dark-palace.png")
                }
                alt="image"
                size="none"
                className="h-[60px] w-[60px]"
              />
              <Text className="font-medium text-typography-800">Bengaluru</Text>
            </VStack>
          </HStack>

          <Input className="px-4 rounded-full h-12 bg-background-50 border border-secondary-100">
            <InputSlot>
              <InputIcon
                as={SearchIcon}
                size="sm"
                className="text-secondary-800"
              />
            </InputSlot>
            <InputField
              placeholder="Search for a city"
              className="placeholder:text-typography-600"
            />
            <InputSlot>
              <InputIcon as={Mic} size="sm" className="text-secondary-800" />
            </InputSlot>
          </Input>
        </VStack>
      </LinearGradient>

      <ScrollView
        contentContainerClassName="gap-y-3 px-5"
        showsVerticalScrollIndicator={false}
      >
        {locationCardList.map((card: any) => {
          return (
            <LocationCard
              key={card.id}
              id={card.id}
              country={card.country}
              time={card.time}
              temperature={card.temperature}
              weather={card.weather}
              AQI={card.AQI}
              wind={card.wind}
              highest={card.highest}
              lowest={card.lowest}
              isSelected={selectedCard === card.id}
              setSelectedCard={setSelectedCard}
            />
          );
        })}
      </ScrollView>
    </VStack>
  );
};

export default Location;
