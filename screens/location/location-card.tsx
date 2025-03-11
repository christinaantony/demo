import React from "react";
import { HStack } from "@/components/ui/hstack";
import { Text } from "@/components/ui/text";
import { Icon } from "@/components/ui/icon";
import { CloudRainWind, CloudSun, Wind } from "lucide-react-native";
import { VStack } from "@/components/ui/vstack";
import { Divider } from "@/components/ui/divider";
import { Pressable } from "@/components/ui/pressable";

interface ILocationCard {
  id: number;
  country: string;
  time: string;
  temperature: number;
  weather: string;
  AQI: number;
  wind: string;
  highest: number;
  lowest: number;
  isSelected: boolean;
  setSelectedCard: (key: number) => void;
}

const LocationCard = ({
  id,
  country,
  time,
  temperature,
  weather,
  AQI,
  wind,
  highest,
  lowest,
  isSelected,
  setSelectedCard,
}: ILocationCard) => {
  return (
    <Pressable
      className={`p-3 rounded-[18px] gap-4 flex-col ${
        isSelected ? "bg-primary-200" : "bg-primary-50"
      }`}
      onPress={() => setSelectedCard(id)}
    >
      <HStack>
        <VStack className="flex-1">
          <Text size="lg" className="font-semibold text-typography-800">
            {country}
          </Text>
          <Text size="sm" className="font-medium text-typography-600">
            {time}
          </Text>
        </VStack>

        <HStack className="items-center" space="sm">
          <VStack>
            <Text className="text-right">{highest}°</Text>
            <Text>{lowest}°</Text>
          </VStack>
          <Divider orientation="vertical" className="bg-outline-200 h-[62px]" />
          <Text size="5xl" className="text-typography-800">
            {temperature}°
          </Text>
        </HStack>
      </HStack>

      <HStack className="justify-between">
        <HStack space="xs">
          <Text className="text-typography-600 font-medium" size="xs">
            {weather}
          </Text>
          <Icon as={CloudRainWind} size="sm" className="text-typography-600" />
        </HStack>

        <HStack space="xs">
          <Text className="text-typography-600 font-medium" size="xs">
            {AQI} AQI
          </Text>
          <Icon as={CloudSun} size="sm" className="text-typography-600" />
        </HStack>

        <HStack space="xs">
          <Text className="text-typography-600 font-medium" size="xs">
            {wind} wind
          </Text>
          <Icon as={Wind} size="sm" className="text-typography-600" />
        </HStack>
      </HStack>
    </Pressable>
  );
};

export default LocationCard;
