import React from "react";
import { Box } from "@/components/ui/box";
import { VStack } from "@/components/ui/vstack";
import { Text } from "@/components/ui/text";
import { Image } from "@/components/ui/image";

interface IForeCastCard {
  time: string;
  imgUrl: any;
  temperature: number;
}

const ForeCastCard = ({ time, imgUrl, temperature }: IForeCastCard) => {
  return (
    <VStack className="gap-1.5 items-center">
      <Text size="sm" className="text-typography-900">
        {time}
      </Text>
      <Box className="h-8 w-8">
        <Image
          source={imgUrl}
          alt="image"
          className="h-full w-full"
          contentFit="contain"
        />
      </Box>
      <Text className="text-typography-900">{temperature}°</Text>
    </VStack>
  );
};

export default ForeCastCard;
